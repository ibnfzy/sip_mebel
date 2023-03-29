<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriItemModel extends Model
{
    protected $table            = 'kategori_item';
    protected $primaryKey       = 'id_kategori';
    protected $allowedFields    = [
        'nama_kategori'
    ];
}