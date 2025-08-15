<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    // Menampilkan halaman login admin
    public function index()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/admin/booking');
        }
        return view('admin/auth/login');
    }

    // Memproses upaya login admin
    // public function authenticate()
    // {
    //     // 1. Ambil semua data POST yang dikirim form
    //     $postData = $this->request->getPost();
    //     echo "<h2>Data POST yang Diterima:</h2>";
    //     var_dump($postData);
    //     echo "<hr>";

    //     // 2. Ambil username dan password secara spesifik
    //     $username = $this->request->getPost('username');
    //     $password = $this->request->getPost('password');
    //     echo "<h2>Variabel Username & Password:</h2>";
    //     echo "Username dari form: '" . $username . "'<br>";
    //     echo "Password dari form: '" . $password . "'<br>";
    //     echo "<hr>";

    //     // 3. Cari user di database
    //     $userModel = new \App\Models\UserModel();
    //     $user = $userModel->where('username', $username)->first();
    //     echo "<h2>Hasil Pencarian User di DB:</h2>";
    //     var_dump($user);
    //     echo "<hr>";

    //     // 4. Lakukan verifikasi jika user ditemukan
    //     if ($user) {
    //         echo "<h2>Proses Verifikasi Password:</h2>";
    //         echo "Hasil akhir: ";
    //         var_dump(password_verify($password, $user['password']));
    //         echo "<hr>";
    //     }

    //     die; // Hentikan semuanya di sini agar kita bisa lihat hasilnya.
    // }

    public function authenticate()
    {
        $session = session();
        $userModel = new \App\Models\UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');


        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            $ses_data = [
                'userId'       => $user['id'],
                'namaLengkap'  => $user['nama_lengkap'],
                'username'     => $user['username'],
                'role'         => $user['role'],
                'isLoggedIn'   => TRUE
            ];
            $session->set($ses_data);

            return redirect()->to('/admin/booking');
        }

        $session->setFlashdata('error', 'Username atau Password salah.');
        return redirect()->to('/admin/login');
    }

    // Proses logout admin
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/login');
    }
}
