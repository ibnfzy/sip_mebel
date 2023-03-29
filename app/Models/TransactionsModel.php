<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionsModel extends Model
{
    protected $table            = 'transactions';
    protected $primaryKey       = 'id_transactions';
    protected $allowedFields    = [
        'id_item',
        'id_pembeli',
        'rowid',
        'fullname',
        'nama_item',
        'total_harga',
        'transactions_datetime',
        'qty_transactions',
    ];
}