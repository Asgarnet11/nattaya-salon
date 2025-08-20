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
        $this->galeriModel = new GaleriModel();
        $this->layananModel = new LayananModel();
        $this->gambarLayananModel = new GambarLayananModel();
        $this->paketLayananModel = new PaketLayananModel();
        $this->artikelModel = new ArtikelModel();
        $this->cabangModel = new CabangModel();
        $this->bookingModel = new BookingModel();
        helper('text');
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
            'meta_description'   => 'Nattaya Salon Kendari adalah salon kecantikan terkemuka di Kendari dengan 3 cabang. Nikmati layanan profesional mulai dari haircut, facial, hingga spa.',
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
            'meta_description'   => 'Lihat semua layanan profesional yang kami tawarkan di Nattaya Salon Kendari, mulai dari perawatan rambut, wajah, hingga tubuh.',
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
            'title'            => $layanan['nama_layanan'],
            'meta_description'   => esc(word_limiter($layanan['deskripsi'], 20)),
            'layanan'          => $layanan,
            'gambar'           => $this->gambarLayananModel->where('id_layanan', $id)->findAll(),
            'paket'            => $this->paketLayananModel->where('id_layanan', $id)->findAll(),
        ];
        return view('frontend/detail_layanan', $data);
    }

    public function galeri()
    {
        $data = [
            'title'  => 'Galeri Kami',
            'meta_description'   => 'Lihat koleksi foto hasil kerja dari para stylist profesional kami di Nattaya Salon Kendari.',
            'galeri' => $this->galeriModel->orderBy('id', 'DESC')->findAll()
        ];
        return view('frontend/galeri', $data);
    }

    public function artikel()
    {
        $data = [
            'title'   => 'Artikel & Tips',
            'meta_description'   => 'Baca artikel dan tips terbaru seputar dunia kecantikan, rambut, dan perawatan diri dari para ahli di Nattaya Salon.',
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
            'meta_description'   => esc(word_limiter($artikel['isi_artikel'], 20)),
            'artikel' => $artikel,
        ];
        return view('frontend/detail_artikel', $data);
    }

    public function lokasi()
    {
        $data = [
            'title'  => 'Lokasi Kami',
            'meta_description'   => 'Temukan 3 lokasi cabang Nattaya Salon di Kendari. Dapatkan alamat, nomor telepon, dan petunjuk arah di sini.',
            'cabang' => $this->cabangModel->findAll(),
        ];
        return view('frontend/lokasi', $data);
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
        $rules = [
            'id_cabang'        => 'required|is_natural_no_zero',
            'id_paket_layanan' => 'required|is_natural_no_zero',
            'tanggal_booking'  => 'required|valid_date[Y-m-d]',
            'jam_booking'      => 'required'
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->bookingModel->save([
            'id_pelanggan'     => session()->get('pelanggan_id'),
            'id_cabang'        => $this->request->getPost('id_cabang'),
            'id_paket_layanan' => $this->request->getPost('id_paket_layanan'),
            'tanggal_booking'  => $this->request->getPost('tanggal_booking'),
            'jam_booking'      => $this->request->getPost('jam_booking'),
            'status'           => 'waiting_payment',
        ]);
        $idBookingBaru = $this->bookingModel->getInsertID();
        return redirect()->to('/pembayaran/' . $idBookingBaru);
    }

    public function pembayaran($id_booking)
    {
        $booking = $this->bookingModel
            ->select('jadwal_booking.*, paket_layanan.nama_paket, paket_layanan.harga')
            ->join('paket_layanan', 'paket_layanan.id = jadwal_booking.id_paket_layanan')
            ->find($id_booking);

        if (!$booking || $booking['id_pelanggan'] != session()->get('pelanggan_id')) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title'   => 'Instruksi Pembayaran',
            'booking' => $booking
        ];
        return view('frontend/pembayaran', $data);
    }

    public function konfirmasi_pembayaran_form($id_booking)
    {
        $data = [
            'title'      => 'Konfirmasi Pembayaran',
            'id_booking' => $id_booking
        ];
        return view('frontend/konfirmasi_pembayaran', $data);
    }

    public function proses_konfirmasi()
    {
        $id_booking = $this->request->getPost('id_booking');
        $fileBukti = $this->request->getFile('bukti_pembayaran');

        if ($fileBukti && $fileBukti->isValid() && !$fileBukti->hasMoved()) {
            $namaFile = $fileBukti->getRandomName();
            $fileBukti->move('uploads/bukti_pembayaran', $namaFile);

            $this->bookingModel->update($id_booking, [
                'bukti_pembayaran' => $namaFile,
                'status'           => 'waiting_verification'
            ]);

            return redirect()->to('/riwayat-booking')->with('success', 'Konfirmasi pembayaran berhasil dikirim. Mohon tunggu verifikasi dari admin.');
        }
        return redirect()->back()->with('error', 'Gagal mengupload bukti pembayaran. Pastikan Anda sudah memilih file.');
    }

    public function getPaketByLayanan($id_layanan)
    {
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
            ->orderBy('jadwal_booking.created_at', 'DESC')
            ->findAll();

        $data = [
            'title'   => 'Riwayat Booking Saya',
            'riwayat' => $riwayat,
        ];
        return view('frontend/riwayat_booking', $data);
    }
}
