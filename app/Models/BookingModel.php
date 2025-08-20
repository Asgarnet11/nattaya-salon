<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table            = 'jadwal_booking';
    protected $primaryKey       = 'id';

    protected $allowedFields    = [
        'id_pelanggan',
        'id_cabang',
        'id_paket_layanan',
        'id_karyawan',
        'tanggal_booking',
        'jam_booking',
        'status',
        'bukti_pembayaran', // <-- PASTIKAN FIELD INI ADA DI SINI
        'created_at'
    ];

    // Mengaktifkan timestamps otomatis
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = ''; // Tidak ada updated_at
}
