<?php

namespace App\Models;

use CodeIgniter\Model;

class CabangModel extends Model
{
    protected $table            = 'cabang';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nama_cabang', 'alamat', 'no_telepon'];
}
