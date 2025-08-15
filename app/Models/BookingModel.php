<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table            = 'jadwal_booking';
    protected $primaryKey       = 'id';

    // Perhatikan perubahan di baris ini: id_layanan diganti menjadi id_paket_layanan
    protected $allowedFields    = [
        'id_pelanggan',
        'id_cabang',
        'id_paket_layanan',
        'id_karyawan',
        'tanggal_booking',
        'jam_booking',
        'status',
        'created_at'
    ];

    // Mengaktifkan timestamps otomatis
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = ''; // Tidak ada updated_at
}
