<?php

namespace App\Models;

use CodeIgniter\Model;

class LayananModel extends Model
{
    protected $table            = 'layanan';
    protected $primaryKey       = 'id';
    // Hanya nama dan deskripsi yang diizinkan
    protected $allowedFields    = ['nama_layanan', 'deskripsi'];
}
