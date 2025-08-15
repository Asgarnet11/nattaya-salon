<?php

namespace App\Controllers;

use App\Models\GaleriModel;
use App\Models\LayananModel;
use App\Models\GambarLayananModel;
use App\Models\PaketLayananModel;
use App\Models\ArtikelModel;
use App\Models\CabangModel;
use App\Models\BookingModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Home extends BaseController
{
    protected $galeriModel;
    protected $layananModel;
    protected $gambarLayananModel;
    protected $paketLayananModel;
    protected $artikelModel;
    protected $cabangModel;
    protected $bookingModel;

    public function __construct()
    {
        // Menginisialisasi semua model yang dibutuhkan
        $this->galeriModel = new GaleriModel();
        $this->layananModel = new LayananModel();
        $this->gambarLayananModel = new GambarLayananModel();
        $this->paketLayananModel = new PaketLayananModel();
        $this->artikelModel = new ArtikelModel();
        $this->cabangModel = new CabangModel();
        $this->bookingModel = new BookingModel();
        helper('text'); // Memuat text helper sekali untuk semua metode
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('layanan AS l');
        $builder->select('l.id, l.nama_layanan, (SELECT MIN(pl.harga) FROM paket_layanan pl WHERE pl.id_layanan = l.id) as harga_mulai');
        $builder->limit(3);
        $builder->orderBy('l.id', 'DESC');
        $layananUnggulan = $builder->get()->getResultArray();

        $data = [
            'title'              => 'Selamat Datang',
            'layanan_unggulan'   => $layananUnggulan,
            'galeri_terbaru'     => $this->galeriModel->orderBy('id', 'DESC')->limit(4)->findAll(),
        ];

        return view('frontend/home', $data);
    }

    public function layanan()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('layanan AS l');
        $builder->select('l.id, l.nama_layanan, l.deskripsi, (SELECT MIN(pl.harga) FROM paket_layanan pl WHERE pl.id_layanan = l.id) as harga_mulai, (SELECT gl.nama_file FROM gambar_layanan gl WHERE gl.id_layanan = l.id ORDER BY gl.id ASC LIMIT 1) as gambar_sampul');
        $layananData = $builder->get()->getResultArray();

        $data = [
            'title'   => 'Daftar Layanan Kami',
            'layanan' => $layananData
        ];
        return view('frontend/layanan', $data);
    }

    public function detail_layanan($id)
    {
        if (!$layanan = $this->layananModel->find($id)) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title'   => $layanan['nama_layanan'],
            'layanan' => $layanan,
            'gambar'  => $this->gambarLayananModel->where('id_layanan', $id)->findAll(),
            'paket'   => $this->paketLayananModel->where('id_layanan', $id)->findAll(),
        ];

        return view('frontend/detail_layanan', $data);
    }

    public function galeri()
    {
        $data = [
            'title'  => 'Galeri Kami',
            'galeri' => $this->galeriModel->orderBy('id', 'DESC')->findAll()
        ];
        return view('frontend/galeri', $data);
    }

    public function artikel()
    {
        $data = [
            'title'   => 'Artikel & Tips',
            'artikel' => $this->artikelModel->orderBy('id', 'DESC')->findAll(),
        ];
        return view('frontend/artikel', $data);
    }

    public function detail_artikel($slug)
    {
        if (!$artikel = $this->artikelModel->where('slug', $slug)->first()) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title'   => $artikel['judul'],
            'artikel' => $artikel,
        ];
        return view('frontend/detail_artikel', $data);
    }

    public function kontak()
    {
        $data = ['title' => 'Hubungi Kami'];
        return view('frontend/kontak', $data);
    }

    public function booking()
    {
        $data = [
            'title'   => 'Booking Online',
            'cabang'  => $this->cabangModel->findAll(),
            'layanan' => $this->layananModel->findAll(),
        ];
        return view('frontend/booking', $data);
    }

    public function proses_booking()
    {
        // Aturan validasi
        $rules = [
            'id_cabang'        => 'required|is_natural_no_zero',
            'id_paket_layanan' => 'required|is_natural_no_zero',
            'tanggal_booking'  => 'required|valid_date[Y-m-d]',
            'jam_booking'      => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Validasi tanggal tidak boleh di masa lalu
        if ($this->request->getPost('tanggal_booking') < date('Y-m-d')) {
            return redirect()->back()->withInput()->with('error', 'Tanggal booking tidak boleh di masa lalu.');
        }

        // Simpan data ke database
        $this->bookingModel->save([
            'id_pelanggan'     => session()->get('pelanggan_id'),
            'id_cabang'        => $this->request->getPost('id_cabang'),
            'id_paket_layanan' => $this->request->getPost('id_paket_layanan'),
            'tanggal_booking'  => $this->request->getPost('tanggal_booking'),
            'jam_booking'      => $this->request->getPost('jam_booking'),
            'status'           => 'pending',
        ]);

        return redirect()->to('/booking')->with('success', 'Booking Anda berhasil dikirim! Kami akan segera menghubungi Anda untuk konfirmasi.');
    }

    public function getPaketByLayanan($id_layanan)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403);
        }
        $paket = $this->paketLayananModel->where('id_layanan', $id_layanan)->findAll();
        return $this->response->setJSON($paket);
    }

    public function riwayat_booking()
    {
        $id_pelanggan = session()->get('pelanggan_id');
        $riwayat = $this->bookingModel
            ->select('jadwal_booking.*, paket_layanan.nama_paket, layanan.nama_layanan, cabang.nama_cabang')
            ->join('paket_layanan', 'paket_layanan.id = jadwal_booking.id_paket_layanan')
            ->join('layanan', 'layanan.id = paket_layanan.id_layanan')
            ->join('cabang', 'cabang.id = jadwal_booking.id_cabang')
            ->where('jadwal_booking.id_pelanggan', $id_pelanggan)
            ->orderBy('jadwal_booking.tanggal_booking', 'DESC')
            ->findAll();

        $data = [
            'title'   => 'Riwayat Booking Saya',
            'riwayat' => $riwayat,
        ];

        return view('frontend/riwayat_booking', $data);
    }

    public function batalkan_booking($id)
    {
        $booking = $this->bookingModel->where('id', $id)
            ->where('id_pelanggan', session()->get('pelanggan_id'))
            ->first();

        if (!$booking) {
            return redirect()->to('/riwayat-booking')->with('error', 'Booking tidak ditemukan.');
        }

        // Hanya booking pending yang bisa dibatalkan oleh pelanggan
        if ($booking['status'] !== 'pending') {
            return redirect()->to('/riwayat-booking')->with('error', 'Booking ini tidak dapat dibatalkan.');
        }

        $this->bookingModel->update($id, ['status' => 'canceled']);
        return redirect()->to('/riwayat-booking')->with('success', 'Booking berhasil dibatalkan.');
    }
}
