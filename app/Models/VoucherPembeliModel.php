<?php

namespace App\Models;

use CodeIgniter\Model;

class VoucherPembeliModel extends Model
{
    protected $table            = 'voucher_pembeli';
    protected $primaryKey       = 'id_pembeli_voucher';
    protected $allowedFields    = [
        'id_pembeli',
        'id_voucher',
        'fullname',
        'potongan',
        'status',
        'up_datetime',
    ];
}