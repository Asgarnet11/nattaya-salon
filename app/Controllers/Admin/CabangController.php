<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CabangModel; // Jangan lupa import model

class CabangController extends BaseController
{
    protected $cabangModel;

    public function __construct()
    {
        // Buat objek model di constructor
        $this->cabangModel = new CabangModel();
    }

    // Menampilkan daftar semua cabang
    public function index()
    {
        $data = [
            'title'  => 'Manajemen Cabang',
            'cabang' => $this->cabangModel->findAll() // Ambil semua data
        ];

        return view('admin/cabang/index', $data);
    }

    // Menampilkan form tambah data
    public function new()
    {
        $data = [
            'title' => 'Tambah Cabang Baru'
        ];
        return view('admin/cabang/new', $data);
    }

    // Memproses data dari form tambah
    public function create()
    {
        // Ambil data dari form
        $data = [
            'nama_cabang' => $this->request->getPost('nama_cabang'),
            'alamat'      => $this->request->getPost('alamat'),
            'no_telepon'  => $this->request->getPost('no_telepon'),
        ];

        // Simpan data ke database
        $this->cabangModel->insert($data);

        // Redirect kembali ke halaman daftar cabang dengan pesan sukses
        return redirect()->to('/admin/cabang')->with('success', 'Data cabang berhasil ditambahkan.');
    }

    public function edit($id = null)
    {
        $data = [
            'title'  => 'Edit Data Cabang',
            'cabang' => $this->cabangModel->find($id) // Ambil data berdasarkan ID
        ];

        // Jika data tidak ditemukan, tampilkan error 404
        if (empty($data['cabang'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cabang dengan ID ' . $id . ' tidak ditemukan.');
        }

        return view('admin/cabang/edit', $data);
    }

    public function update($id = null)
    {
        $data = [
            'nama_cabang' => $this->request->getPost('nama_cabang'),
            'alamat'      => $this->request->getPost('alamat'),
            'no_telepon'  => $this->request->getPost('no_telepon'),
        ];

        $this->cabangModel->update($id, $data); // Update data berdasarkan ID

        return redirect()->to('/admin/cabang')->with('success', 'Data cabang berhasil diperbarui.');
    }

    // Menghapus data cabang
    public function delete($id = null)
    {
        $this->cabangModel->delete($id); // Hapus data berdasarkan ID

        return redirect()->to('/admin/cabang')->with('success', 'Data cabang berhasil dihapus.');
    }
}
