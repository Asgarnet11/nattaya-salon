<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ArtikelModel;

class ArtikelController extends BaseController
{
    protected $artikelModel;

    public function __construct()
    {
        $this->artikelModel = new ArtikelModel();
    }

    public function index()
    {
        $data = [
            'title'   => 'Manajemen Artikel',
            'artikel' => $this->artikelModel->findAll()
        ];
        return view('admin/artikel/index', $data);
    }

    public function new()
    {
        $data = ['title' => 'Tulis Artikel Baru'];
        return view('admin/artikel/new', $data);
    }

    public function create()
    {
        // Membuat 'slug' (URL friendly) dari judul
        $slug = url_title($this->request->getPost('judul'), '-', true);

        $this->artikelModel->save([
            'judul'       => $this->request->getPost('judul'),
            'slug'        => $slug,
            'isi_artikel' => $this->request->getPost('isi_artikel'),
            'penulis'     => session()->get('namaLengkap'), // Ambil nama admin yang login
        ]);
        return redirect()->to('/admin/artikel')->with('success', 'Artikel berhasil diterbitkan.');
    }

    public function edit($id = null)
    {
        $data = [
            'title'   => 'Edit Artikel',
            'artikel' => $this->artikelModel->find($id)
        ];
        return view('admin/artikel/edit', $data);
    }

    public function update($id = null)
    {
        $slug = url_title($this->request->getPost('judul'), '-', true);
        $this->artikelModel->update($id, [
            'judul'       => $this->request->getPost('judul'),
            'slug'        => $slug,
            'isi_artikel' => $this->request->getPost('isi_artikel'),
        ]);
        return redirect()->to('/admin/artikel')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function delete($id = null)
    {
        $this->artikelModel->delete($id);
        return redirect()->to('/admin/artikel')->with('success', 'Artikel berhasil dihapus.');
    }
}
