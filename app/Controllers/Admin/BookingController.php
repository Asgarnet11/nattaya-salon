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
     * Menampilkan daftar booking.
     * Superadmin melihat semua booking, admin hanya melihat booking cabangnya.
     */
    public function index()
    {
        $builder = $this->bookingModel
            ->select('
                jadwal_booking.*, 
                paket_layanan.nama_paket, 
                layanan.nama_layanan, 
                cabang.nama_cabang, 
                karyawan.nama_karyawan,
                pelanggan.nama_lengkap as nama_pelanggan,
                pelanggan.no_telepon
            ')
            ->join('paket_layanan', 'paket_layanan.id = jadwal_booking.id_paket_layanan')
            ->join('layanan', 'layanan.id = paket_layanan.id_layanan')
            ->join('cabang', 'cabang.id = jadwal_booking.id_cabang')
            ->join('pelanggan', 'pelanggan.id = jadwal_booking.id_pelanggan')
            ->join('karyawan', 'karyawan.id = jadwal_booking.id_karyawan', 'left');

        // Filter data jika yang login adalah admin cabang
        if (session()->get('role') === 'admin') {
            $builder->where('jadwal_booking.id_cabang', session()->get('id_cabang'));
        }

        $data = [
            'title'    => 'Manajemen Booking',
            'bookings' => $builder->orderBy('jadwal_booking.created_at', 'DESC')->findAll()
        ];
        return view('admin/booking/index', $data);
    }

    /**
     * Menampilkan halaman untuk mengelola satu booking.
     */
    public function edit($id = null)
    {
        if (!$id || !is_numeric($id)) {
            throw PageNotFoundException::forPageNotFound();
        }

        $booking = $this->bookingModel->find($id);

        if (empty($booking)) {
            throw PageNotFoundException::forPageNotFound();
        }

        // Keamanan: Pastikan admin hanya bisa mengakses booking di cabangnya
        if (session()->get('role') === 'admin' && $booking['id_cabang'] != session()->get('id_cabang')) {
            throw PageNotFoundException::forPageNotFound('Anda tidak memiliki akses ke booking ini.');
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
        // Lakukan pengecekan yang sama seperti di 'edit' sebelum update
        $booking = $this->bookingModel->find($id);
        if (session()->get('role') === 'admin' && $booking['id_cabang'] != session()->get('id_cabang')) {
            return redirect()->to('/admin/booking')->with('error', 'Akses ditolak.');
        }

        $this->bookingModel->update($id, [
            'id_karyawan' => $this->request->getPost('id_karyawan') ?: null,
            'status'      => $this->request->getPost('status'),
        ]);
        return redirect()->to('/admin/booking')->with('success', 'Booking berhasil diperbarui.');
    }

    /**
     * Menghapus data booking.
     */
    public function delete($id = null)
    {
        // Lakukan pengecekan yang sama seperti di 'edit' sebelum hapus
        $booking = $this->bookingModel->find($id);
        if (session()->get('role') === 'admin' && $booking['id_cabang'] != session()->get('id_cabang')) {
            return redirect()->to('/admin/booking')->with('error', 'Akses ditolak.');
        }

        $this->bookingModel->delete($id);
        return redirect()->to('/admin/booking')->with('success', 'Booking berhasil dihapus.');
    }

    /**
     * Menampilkan halaman kalender booking.
     */
    public function kalender()
    {
        $data = ['title' => 'Kalender Booking'];
        return view('admin/booking/kalender', $data);
    }

    /**
     * Menyediakan data booking dalam format JSON untuk FullCalendar.
     * Superadmin melihat semua, admin hanya melihat data cabangnya.
     */
    public function getBookingsApi()
    {
        $builder = $this->bookingModel
            ->select('
                jadwal_booking.id, 
                jadwal_booking.tanggal_booking, 
                jadwal_booking.jam_booking, 
                jadwal_booking.status,
                pelanggan.nama_lengkap as nama_pelanggan,
                paket_layanan.nama_paket
            ')
            ->join('pelanggan', 'pelanggan.id = jadwal_booking.id_pelanggan')
            ->join('paket_layanan', 'paket_layanan.id = jadwal_booking.id_paket_layanan');

        // Filter data jika yang login adalah admin cabang
        if (session()->get('role') === 'admin') {
            $builder->where('jadwal_booking.id_cabang', session()->get('id_cabang'));
        }

        $bookings = $builder->findAll();

        $events = [];
        foreach ($bookings as $booking) {
            $events[] = [
                'title' => esc($booking['nama_pelanggan'] . ' - ' . $booking['nama_paket']),
                'start' => $booking['tanggal_booking'] . 'T' . $booking['jam_booking'],
                'url'   => site_url('admin/booking/' . $booking['id'] . '/edit'),
                'color' => $this->getStatusColor($booking['status'])
            ];
        }

        return $this->response->setJSON($events);
    }

    /**
     * Fungsi pembantu untuk memberikan warna pada event kalender berdasarkan status.
     */
    private function getStatusColor($status)
    {
        switch ($status) {
            case 'confirmed':
                return '#28a745'; // Hijau
            case 'pending':
                return '#ffc107'; // Kuning
            case 'completed':
                return '#6c757d'; // Abu-abu
            case 'canceled':
                return '#dc3545'; // Merah
            default:
                return '#007bff'; // Biru
        }
    }
}
