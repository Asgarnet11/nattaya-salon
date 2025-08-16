<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\PelangganModel;
use App\Models\LayananModel;

class DashboardController extends BaseController
{
    /**
     * Menampilkan halaman dashboard dengan data yang relevan
     * berdasarkan role user (superadmin atau admin).
     */
    public function index()
    {
        $bookingModel = new BookingModel();
        $id_cabang = session()->get('id_cabang');
        $role = session()->get('role');

        // --- 1. Data untuk Kartu Statistik ---

        // Jumlah Booking Pending
        $pendingBuilder = $bookingModel->where('status', 'pending');
        if ($role === 'admin') {
            $pendingBuilder->where('id_cabang', $id_cabang);
        }
        $data['jumlahBookingPending'] = $pendingBuilder->countAllResults();

        // Jumlah Booking Hari Ini
        $hariIniBuilder = $bookingModel->where('tanggal_booking', date('Y-m-d'));
        if ($role === 'admin') {
            $hariIniBuilder->where('id_cabang', $id_cabang);
        }
        $data['jumlahBookingHariIni'] = $hariIniBuilder->countAllResults();

        // Statistik global yang hanya relevan untuk superadmin, tapi bisa ditampilkan untuk semua
        $data['jumlahPelanggan'] = (new PelangganModel())->countAllResults();
        $data['jumlahLayanan'] = (new LayananModel())->countAllResults();

        // --- 2. Data untuk Tabel Booking Terbaru ---
        $terbaruBuilder = $bookingModel
            ->select('jadwal_booking.*, pelanggan.nama_lengkap')
            ->join('pelanggan', 'pelanggan.id = jadwal_booking.id_pelanggan')
            ->where('jadwal_booking.status', 'pending');

        if ($role === 'admin') {
            $terbaruBuilder->where('jadwal_booking.id_cabang', $id_cabang);
        }

        $data['bookingTerbaru'] = $terbaruBuilder->orderBy('jadwal_booking.id', 'DESC')
            ->limit(5)
            ->findAll();

        // --- 3. Data untuk Grafik Booking 7 Hari Terakhir ---
        $db = \Config\Database::connect();
        $sql_where_cabang = ($role === 'admin') ? "AND id_cabang = " . $db->escape($id_cabang) : "";

        $query = $db->query("
            SELECT DATE(tanggal_booking) as tanggal, COUNT(id) as jumlah 
            FROM jadwal_booking 
            WHERE tanggal_booking >= CURDATE() - INTERVAL 7 DAY 
            {$sql_where_cabang}
            GROUP BY DATE(tanggal_booking) 
            ORDER BY tanggal ASC
        ");

        $chartDataRaw = $query->getResultArray();

        $chartLabels = [];
        $chartData = [];
        foreach ($chartDataRaw as $row) {
            $chartLabels[] = date('d M', strtotime($row['tanggal']));
            $chartData[] = $row['jumlah'];
        }

        $data['chartLabels'] = json_encode($chartLabels);
        $data['chartData'] = json_encode($chartData);

        // --- Kirim semua data ke view ---
        $data['title'] = 'Dashboard';
        return view('admin/dashboard', $data);
    }
}
