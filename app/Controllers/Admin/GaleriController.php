<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GaleriModel;

class GaleriController extends BaseController
{
    protected $galeriModel;

    public function __construct()
    {
        $this->galeriModel = new GaleriModel();
    }

    public function index()
    {
        $data = [
            'title'  => 'Manajemen Galeri',
            'galeri' => $this->galeriModel->findAll()
        ];
        return view('admin/galeri/index', $data);
    }

    public function new()
    {
        $data = ['title' => 'Upload Gambar Baru'];
        return view('admin/galeri/new', $data);
    }

    public function create()
    {
        $fileGambar = $this->request->getFile('gambar');
        if ($fileGambar->isValid() && !$fileGambar->hasMoved()) {
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('uploads/gallery', $namaGambar);
            $this->galeriModel->save([
                'judul'     => $this->request->getPost('judul'),
                'nama_file' => $namaGambar,
            ]);
            return redirect()->to('/admin/galeri')->with('success', 'Gambar berhasil diupload.');
        }
        return redirect()->back()->withInput()->with('error', 'Gagal mengupload gambar.');
    }

    public function delete($id = null)
    {
        // Cari data gambar di database
        $gambar = $this->galeriModel->find($id);
        if ($gambar) {
            // Hapus file gambar dari folder uploads
            $path = 'uploads/gallery/' . $gambar['nama_file'];
            if (file_exists($path)) {
                unlink($path);
            }
            // Hapus data dari database
            $this->galeriModel->delete($id);
            return redirect()->to('/admin/galeri')->with('success', 'Gambar berhasil dihapus.');
        }
        return redirect()->to('/admin/galeri')->with('error', 'Data gambar tidak ditemukan.');
    }
}
