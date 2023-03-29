<?php

namespace App\Models;

use CodeIgniter\Model;

class VoucherSistemModel extends Model
{
    protected $table            = 'voucher_sistem';
    protected $primaryKey       = 'id_voucher_sistem';
    protected $allowedFields    = [
        'id_pembeli',
        'poin',
    ];
}