<?php

namespace App\Models;

use CodeIgniter\Model;

class InformasiTokoModel extends Model
{
    protected $table            = 'informasi_toko';
    protected $primaryKey       = 'id_informasi_toko';
    protected $allowedFields    = [
        'alamat_toko',
        'kontak_toko',
        'biaya_ongkir',
    ];
}