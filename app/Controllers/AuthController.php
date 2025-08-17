<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PelangganModel;

class AuthController extends BaseController
{
    /**
     * Menampilkan halaman form registrasi untuk pelanggan.
     */
    public function register_form()
    {
        $data = ['title' => 'Register Akun Baru'];
        return view('frontend/auth/register', $data);
    }

    /**
     * Memproses data dari form registrasi, mengenkripsi password,
     * dan menyimpannya ke database.
     */
    public function proses_register()
    {
        // Aturan validasi
        $rules = [
            'nama_lengkap' => 'required',
            'email'        => 'required|valid_email|is_unique[pelanggan.email]',
            'no_telepon'   => 'required',
            'password'     => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $pelangganModel = new \App\Models\PelangganModel();
        $pelangganModel->save([
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email'        => $this->request->getPost('email'),
            'no_telepon'   => $this->request->getPost('no_telepon'),
            'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * Menampilkan halaman form login untuk pelanggan.
     */
    public function login_form()
    {
        if (session()->get('pelanggan_logged_in')) {
            return redirect()->to('/booking');
        }

        $data = ['title' => 'Login Pelanggan'];
        return view('frontend/auth/login', $data);
    }

    /**
     * Memproses data dari form login, memverifikasi email dan password,
     * dan membuat session jika berhasil.
     */
    public function proses_login()
    {
        $session = session();
        $pelangganModel = new \App\Models\PelangganModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $pelanggan = $pelangganModel->where('email', $email)->first();

        if ($pelanggan && password_verify($password, $pelanggan['password'])) {
            $session_data = [
                'pelanggan_id'        => $pelanggan['id'],
                'pelanggan_nama'      => $pelanggan['nama_lengkap'],
                'pelanggan_logged_in' => TRUE
            ];
            $session->set($session_data);

            return redirect()->to('/booking');
        }

        $session->setFlashdata('error', 'Email atau Password yang Anda masukkan salah.');
        return redirect()->to('/login');
    }

    /**
     * Menghapus session pelanggan dan mengarahkan ke halaman utama.
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
