<?php

namespace App\Models;

use CodeIgniter\Model;

class VoucherModel extends Model
{
    protected $table            = 'voucher';
    protected $primaryKey       = 'id_voucher';
    protected $allowedFields    = [
        'title_voucher',
        'persen',
        'up_datetime',
    ];
}