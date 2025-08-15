<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KaryawanModel;
use App\Models\CabangModel; // Import CabangModel

class KaryawanController extends BaseController
{
    protected $karyawanModel;
    protected $cabangModel;

    public function __construct()
    {
        $this->karyawanModel = new KaryawanModel();
        $this->cabangModel = new CabangModel(); // Buat objek CabangModel
    }

    // Menampilkan daftar karyawan
    public function index()
    {
        // Query untuk JOIN tabel karyawan dan cabang
        $karyawan = $this->karyawanModel
            ->select('karyawan.*, cabang.nama_cabang')
            ->join('cabang', 'cabang.id = karyawan.id_cabang')
            ->findAll();

        $data = [
            'title'    => 'Manajemen Karyawan',
            'karyawan' => $karyawan
        ];
        return view('admin/karyawan/index', $data);
    }

    // Menampilkan form tambah
    public function new()
    {
        $data = [
            'title'  => 'Tambah Karyawan Baru',
            'cabang' => $this->cabangModel->findAll() // Ambil data cabang untuk dropdown
        ];
        return view('admin/karyawan/new', $data);
    }

    // Memproses data dari form tambah
    public function create()
    {
        $this->karyawanModel->save([
            'nama_karyawan' => $this->request->getPost('nama_karyawan'),
            'id_cabang'     => $this->request->getPost('id_cabang'),
            'spesialisasi'  => $this->request->getPost('spesialisasi'),
            'status'        => $this->request->getPost('status'),
        ]);

        return redirect()->to('/admin/karyawan')->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    public function edit($id = null)
    {
        $data = [
            'title'     => 'Edit Data Karyawan',
            'karyawan'  => $this->karyawanModel->find($id),
            'cabang'    => $this->cabangModel->findAll(), // Untuk dropdown
        ];

        if (empty($data['karyawan'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Karyawan tidak ditemukan.');
        }

        return view('admin/karyawan/edit', $data);
    }

    // Memproses pembaruan data
    public function update($id = null)
    {
        $this->karyawanModel->update($id, [
            'nama_karyawan' => $this->request->getPost('nama_karyawan'),
            'id_cabang'     => $this->request->getPost('id_cabang'),
            'spesialisasi'  => $this->request->getPost('spesialisasi'),
            'status'        => $this->request->getPost('status'),
        ]);

        return redirect()->to('/admin/karyawan')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function delete($id = null)
    {
        $this->karyawanModel->delete($id);
        return redirect()->to('/admin/karyawan')->with('success', 'Data karyawan berhasil dihapus.');
    }
}
