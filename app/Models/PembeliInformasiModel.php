<?php

namespace App\Models;

use CodeIgniter\Model;

class PembeliInformasiModel extends Model
{
    protected $table            = 'pembeli_informasi';
    protected $primaryKey       = 'id_pembeli_informasi';
    protected $allowedFields    = [
        'id_pembeli',
        'alamat',
        'nomor_hp',
    ];
}