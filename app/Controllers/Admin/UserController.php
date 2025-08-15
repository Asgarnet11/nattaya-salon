<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\CabangModel;

class UserController extends BaseController
{
    protected $userModel;
    protected $cabangModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->cabangModel = new CabangModel();
    }

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

    public function new()
    {
        $data = [
            'title' => 'Tambah User Baru',
            'cabang' => $this->cabangModel->findAll()
        ];
        return view('admin/users/new', $data);
    }

    public function create()
    {
        $password = $this->request->getPost('password');
        $this->userModel->save([
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'username'     => $this->request->getPost('username'),
            'password'     => password_hash($password, PASSWORD_DEFAULT),
            'role'         => $this->request->getPost('role'),
            'id_cabang'    => $this->request->getPost('id_cabang') ?: null,
        ]);
        return redirect()->to('/admin/users')->with('success', 'User baru berhasil ditambahkan.');
    }

    public function edit($id = null)
    {
        $data = [
            'title'  => 'Edit User',
            'user'   => $this->userModel->find($id),
            'cabang' => $this->cabangModel->findAll(),
        ];
        return view('admin/users/edit', $data);
    }

    public function update($id = null)
    {
        $password = $this->request->getPost('password');
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'username'     => $this->request->getPost('username'),
            'role'         => $this->request->getPost('role'),
            'id_cabang'    => $this->request->getPost('id_cabang') ?: null,
        ];
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }
        $this->userModel->update($id, $data);
        return redirect()->to('/admin/users')->with('success', 'Data user berhasil diperbarui.');
    }

    public function delete($id = null)
    {
        if ($id == session()->get('userId')) {
            return redirect()->to('/admin/users')->with('error', 'Anda tidak bisa menghapus akun Anda sendiri.');
        }
        $this->userModel->delete($id);
        return redirect()->to('/admin/users')->with('success', 'User berhasil dihapus.');
    }
}
