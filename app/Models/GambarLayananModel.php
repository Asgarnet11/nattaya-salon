<?php

namespace App\Models;

use CodeIgniter\Model;

class GambarLayananModel extends Model
{
    protected $table            = 'gambar_layanan';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_layanan', 'nama_file'];

    // Timestamps
    protected $useTimestamps = false; // Jika Anda tidak memiliki kolom created_at/updated_at
}
