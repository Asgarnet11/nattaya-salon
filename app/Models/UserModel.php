<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['username', 'password', 'nama_lengkap', 'role', 'id_cabang'];

    // Timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = ''; // Kita tidak pakai updated_at

    // --- PERUBAHAN DI SINI ---
    // Memberitahu model untuk menjalankan fungsi 'hashPassword' sebelum insert dan update.
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    /**
     * Fungsi ini akan dipanggil secara otomatis.
     * Ia menerima data, mencari field 'password', mengenkripsinya,
     * lalu mengembalikan data yang sudah siap disimpan.
     */
    protected function hashPassword(array $data)
    {
        // Cek apakah ada field 'password' di dalam data yang dikirim.
        if (!isset($data['data']['password'])) {
            return $data;
        }

        // Enkripsi password dan kembalikan datanya
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }
}
