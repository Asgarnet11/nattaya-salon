<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\CabangModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class UserController extends BaseController
{
    protected $userModel;
    protected $cabangModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->cabangModel = new CabangModel();
    }

    /**
     * Menampilkan daftar semua user.
     */
    public function index()
    {
        $data = [
            'title' => 'Manajemen User',
            'users' => $this->userModel
                ->select('users.*, cabang.nama_cabang')
                ->join('cabang', 'cabang.id = users.id_cabang', 'left')
                ->findAll()
        ];
        return view('admin/users/index', $data);
    }

    /**
     * Menampilkan form untuk menambah user baru.
     */
    public function new()
    {
        $data = [
            'title' => 'Tambah User Baru',
            'cabang' => $this->cabangModel->findAll()
        ];
        return view('admin/users/new', $data);
    }

    /**
     * Memproses data dari form tambah user baru dengan validasi.
     */
    public function create()
    {
        // Aturan validasi yang ketat
        $rules = [
            'nama_lengkap' => 'required|min_length[3]',
            'username'     => 'required|min_length[5]|is_unique[users.username]',
            'password'     => 'required|min_length[6]',
            'pass_confirm' => 'required|matches[password]',
            'role'         => 'required|in_list[admin,superadmin]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Kirim data mentah ke model. Hashing akan ditangani oleh UserModel.
        $this->userModel->save([
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'username'     => $this->request->getPost('username'),
            'password'     => $this->request->getPost('password'),
            'role'         => $this->request->getPost('role'),
            'id_cabang'    => $this->request->getPost('id_cabang') ?: null,
        ]);

        return redirect()->to('/admin/users')->with('success', 'User baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data user.
     */
    public function edit($id = null)
    {
        if (!$id || !$user = $this->userModel->find($id)) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title'  => 'Edit User',
            'user'   => $user,
            'cabang' => $this->cabangModel->findAll(),
        ];
        return view('admin/users/edit', $data);
    }

    /**
     * Memproses update data user dengan validasi.
     */
    public function update($id = null)
    {
        // Aturan validasi untuk update
        $rules = [
            'nama_lengkap' => 'required|min_length[3]',
            'username'     => "required|min_length[5]|is_unique[users.username,id,{$id}]",
            'role'         => 'required|in_list[admin,superadmin]',
        ];

        // Tambahkan validasi password hanya jika field password diisi
        if ($this->request->getPost('password')) {
            $rules['password']     = 'min_length[6]';
            $rules['pass_confirm'] = 'matches[password]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Siapkan data untuk diupdate
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'username'     => $this->request->getPost('username'),
            'role'         => $this->request->getPost('role'),
            'id_cabang'    => $this->request->getPost('id_cabang') ?: null,
        ];

        // Tambahkan password ke data HANYA jika diisi.
        // Hashing akan ditangani otomatis oleh UserModel.
        if ($this->request->getPost('password')) {
            $data['password'] = $this->request->getPost('password');
        }

        $this->userModel->update($id, $data);
        return redirect()->to('/admin/users')->with('success', 'Data user berhasil diperbarui.');
    }

    /**
     * Menghapus data user.
     */
    public function delete($id = null)
    {
        // Mencegah user menghapus akunnya sendiri
        if ($id == session()->get('userId')) {
            return redirect()->to('/admin/users')->with('error', 'Anda tidak bisa menghapus akun Anda sendiri.');
        }

        $this->userModel->delete($id);
        return redirect()->to('/admin/users')->with('success', 'User berhasil dihapus.');
    }
}
