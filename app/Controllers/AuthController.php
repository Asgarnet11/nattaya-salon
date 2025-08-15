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
        $pelangganModel = new PelangganModel();

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
        // Jika sudah login, jangan tampilkan form lagi, redirect ke booking
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
        $pelangganModel = new PelangganModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Cari pelanggan berdasarkan email
        $pelanggan = $pelangganModel->where('email', $email)->first();

        // Verifikasi apakah pelanggan ada dan passwordnya cocok
        if ($pelanggan && password_verify($password, $pelanggan['password'])) {
            // Jika berhasil, siapkan data untuk session
            $session_data = [
                'pelanggan_id'        => $pelanggan['id'],
                'pelanggan_nama'      => $pelanggan['nama_lengkap'],
                'pelanggan_logged_in' => TRUE
            ];
            $session->set($session_data);

            // Arahkan ke halaman booking
            return redirect()->to('/booking');
        }

        // Jika gagal, kembali ke halaman login dengan pesan error
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
