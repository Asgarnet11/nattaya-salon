<?php

namespace App\Models;

use CodeIgniter\Model;

class PaketLayananModel extends Model
{
    protected $table            = 'paket_layanan';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_layanan', 'nama_paket', 'harga', 'durasi_menit'];
}
