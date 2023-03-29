<?php

namespace App\Models;

use CodeIgniter\Model;

class CartItemModel extends Model
{
    protected $table            = 'cart_item';
    protected $primaryKey       = 'id_cart_item';
    protected $allowedFields    = [
        'id_pembeli',
        'id_pembeli_voucher',
        'rowid',
        'total_items',
        'potongan',
        'total_bayar',
        'bukti_bayar',
        'status_bayar',
        'tgl_checkout',
    ];
}