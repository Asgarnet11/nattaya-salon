<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\PelangganModel;
use App\Models\LayananModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $bookingModel = new BookingModel();

        // Data untuk Kartu Statistik
        $data['jumlahBookingPending'] = $bookingModel->where('status', 'pending')->countAllResults();
        $data['jumlahBookingHariIni'] = $bookingModel->where('tanggal_booking', date('Y-m-d'))->countAllResults();
        $data['jumlahPelanggan'] = (new PelangganModel())->countAllResults();
        $data['jumlahLayanan'] = (new LayananModel())->countAllResults();

        // Data untuk Tabel Booking Terbaru
        $data['bookingTerbaru'] = $bookingModel
            ->select('jadwal_booking.*, pelanggan.nama_lengkap')
            ->join('pelanggan', 'pelanggan.id = jadwal_booking.id_pelanggan')
            ->where('jadwal_booking.status', 'pending')
            ->orderBy('jadwal_booking.id', 'DESC')
            ->limit(5)
            ->findAll();

        // Data untuk Grafik Booking 7 Hari Terakhir
        $db = \Config\Database::connect();
        $query = $db->query("SELECT DATE(tanggal_booking) as tanggal, COUNT(id) as jumlah FROM jadwal_booking WHERE tanggal_booking >= CURDATE() - INTERVAL 7 DAY GROUP BY DATE(tanggal_booking) ORDER BY tanggal ASC");
        $chartDataRaw = $query->getResultArray();

        $chartLabels = [];
        $chartData = [];
        foreach ($chartDataRaw as $row) {
            $chartLabels[] = date('d M', strtotime($row['tanggal']));
            $chartData[] = $row['jumlah'];
        }

        $data['chartLabels'] = json_encode($chartLabels);
        $data['chartData'] = json_encode($chartData);

        $data['title'] = 'Dashboard';
        return view('admin/dashboard', $data);
    }
}
