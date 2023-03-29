<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table            = 'item';
    protected $primaryKey       = 'id_item';
    protected $allowedFields    = [
        'nama_item',
        'gambar_item',
        'desc_item',
        'harga_item',
        'kategori_item',
        'stok_item',
        'jam_tgl_upload',
    ];
}