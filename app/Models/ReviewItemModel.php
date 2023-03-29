<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewItemModel extends Model
{
    protected $table            = 'review_item';
    protected $primaryKey       = 'id_review_item';
    protected $allowedFields    = [
        'id_item',
        'id_pembeli',
        'isi_review_item',
        'bintang',
        'insert_datetime',
    ];
}