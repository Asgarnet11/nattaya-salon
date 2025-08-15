<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\KaryawanModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class BookingController extends BaseController
{
    protected $bookingModel;
    protected $karyawanModel;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->karyawanModel = new KaryawanModel();
    }

    /**
     * Menampilkan daftar semua booking yang masuk dengan data terkait.
     */
    public function index()
    {
        $bookings = $this->bookingModel
            ->select('
                jadwal_booking.*, 
                paket_layanan.nama_paket, 
                layanan.nama_layanan, 
                cabang.nama_cabang, 
                karyawan.nama_karyawan,
                pelanggan.nama_lengkap as nama_pelanggan,
                pelanggan.no_telepon
            ')
            // Menggabungkan data dari tabel lain berdasarkan ID
            ->join('paket_layanan', 'paket_layanan.id = jadwal_booking.id_paket_layanan') // Ambil nama paket
            ->join('layanan', 'layanan.id = paket_layanan.id_layanan') // Ambil nama layanan utama
            ->join('cabang', 'cabang.id = jadwal_booking.id_cabang') // Ambil nama cabang
            ->join('pelanggan', 'pelanggan.id = jadwal_booking.id_pelanggan') // Ambil data pelanggan
            ->join('karyawan', 'karyawan.id = jadwal_booking.id_karyawan', 'left') // Ambil nama karyawan (jika ada)
            ->orderBy('jadwal_booking.created_at', 'DESC')
            ->findAll();

        $data = [
            'title'    => 'Manajemen Booking',
            'bookings' => $bookings
        ];
        return view('admin/booking/index', $data);
    }

    /**
     * Menampilkan halaman untuk mengelola satu booking.
     */
    public function edit($id = null)
    {
        // Validasi awal untuk memastikan ID adalah angka
        if (!$id || !is_numeric($id)) {
            throw PageNotFoundException::forPageNotFound();
        }

        $booking = $this->bookingModel->find($id);

        if (empty($booking)) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title'     => 'Kelola Booking',
            'booking'   => $booking,
            'karyawan'  => $this->karyawanModel->where('id_cabang', $booking['id_cabang'])->where('status', 'aktif')->findAll(),
        ];
        return view('admin/booking/edit', $data);
    }

    /**
     * Memproses update status atau penugasan karyawan.
     */
    public function update($id = null)
    {
        // Validasi awal untuk memastikan ID adalah angka
        if (!$id || !is_numeric($id)) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->bookingModel->update($id, [
            'id_karyawan' => $this->request->getPost('id_karyawan') ?: null, // Set NULL jika kosong
            'status'      => $this->request->getPost('status'),
        ]);
        return redirect()->to('/admin/booking')->with('success', 'Booking berhasil diperbarui.');
    }

    /**
     * Menghapus data booking.
     */
    public function delete($id = null)
    {
        // Validasi awal untuk memastikan ID adalah angka
        if (!$id || !is_numeric($id)) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->bookingModel->delete($id);
        return redirect()->to('/admin/booking')->with('success', 'Booking berhasil dihapus.');
    }
}
