<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LayananModel;
use App\Models\GambarLayananModel;
use App\Models\PaketLayananModel; // <-- Tambahkan ini

class LayananController extends BaseController
{
    protected $layananModel;
    protected $gambarLayananModel;
    protected $paketLayananModel; // <-- Tambahkan ini

    public function __construct()
    {
        $this->layananModel = new LayananModel();
        $this->gambarLayananModel = new GambarLayananModel();
        $this->paketLayananModel = new PaketLayananModel(); // <-- Inisialisasi
    }

    public function index()
    {
        helper('text'); // <-- TAMBAHKAN BARIS INI

        $data = [
            'title'   => 'Manajemen Layanan',
            'layanan' => $this->layananModel->findAll()
        ];
        return view('admin/layanan/index', $data);
    }

    public function new()
    {
        $data = ['title' => 'Tambah Layanan Baru'];
        return view('admin/layanan/new', $data);
    }

    public function create()
    {
        $this->layananModel->save([
            'nama_layanan' => $this->request->getPost('nama_layanan'),
            'deskripsi'    => $this->request->getPost('deskripsi'),
        ]);
        // Arahkan ke halaman edit untuk menambah paket dan gambar
        $idLayananBaru = $this->layananModel->getInsertID();
        return redirect()->to('/admin/layanan/' . $idLayananBaru . '/edit')
            ->with('success', 'Layanan utama berhasil dibuat. Sekarang tambahkan paket dan gambar.');
    }

    public function edit($id = null)
    {
        $data = [
            'title'   => 'Edit Layanan',
            'layanan' => $this->layananModel->find($id),
            'gambar'  => $this->gambarLayananModel->where('id_layanan', $id)->findAll(),
            'paket'   => $this->paketLayananModel->where('id_layanan', $id)->findAll()
        ];
        return view('admin/layanan/edit', $data);
    }

    public function update($id = null)
    {
        // Update data utama (nama, deskripsi)
        $this->layananModel->update($id, [
            'nama_layanan' => $this->request->getPost('nama_layanan'),
            'deskripsi'    => $this->request->getPost('deskripsi'),
        ]);

        // Proses jika ada gambar baru yang diupload
        $filesGambar = $this->request->getFiles();
        if ($filesGambar && isset($filesGambar['gambar_baru'])) {
            foreach ($filesGambar['gambar_baru'] as $img) {
                if ($img->isValid() && !$img->hasMoved()) {
                    $namaGambar = $img->getRandomName();
                    $img->move('uploads/layanan', $namaGambar);
                    $this->gambarLayananModel->save([
                        'id_layanan' => $id,
                        'nama_file'  => $namaGambar,
                    ]);
                }
            }
        }
        return redirect()->back()->with('success', 'Data layanan berhasil diperbarui.');
    }

    public function delete($id = null)
    {
        // Implementasi hapus layanan dan file gambarnya
        $semuaGambar = $this->gambarLayananModel->where('id_layanan', $id)->findAll();
        if ($semuaGambar) {
            foreach ($semuaGambar as $gambar) {
                $path = 'uploads/layanan/' . $gambar['nama_file'];
                if (file_exists($path)) unlink($path);
            }
        }
        $this->layananModel->delete($id);
        return redirect()->to('/admin/layanan')->with('success', 'Layanan berhasil dihapus.');
    }

    // --- FUNGSI BARU UNTUK PAKET ---
    public function tambahPaket()
    {
        $this->paketLayananModel->save($this->request->getPost());
        return redirect()->back()->with('success', 'Paket baru berhasil ditambahkan.');
    }

    public function hapusPaket($idPaket = null)
    {
        $this->paketLayananModel->delete($idPaket);
        return redirect()->back()->with('success', 'Paket berhasil dihapus.');
    }

    // --- FUNGSI LAMA UNTUK GAMBAR (TETAP DIPERLUKAN) ---
    public function deleteImage($idGambar = null)
    {
        $gambar = $this->gambarLayananModel->find($idGambar);
        if ($gambar) {
            $path = 'uploads/layanan/' . $gambar['nama_file'];
            if (file_exists($path)) unlink($path);
            $this->gambarLayananModel->delete($idGambar);
        }
        return redirect()->back()->with('success', 'Gambar berhasil dihapus.');
    }
}
