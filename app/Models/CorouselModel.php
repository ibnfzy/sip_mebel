<?php

namespace App\Models;

use CodeIgniter\Model;

class CorouselModel extends Model
{
    protected $table            = 'corousel';
    protected $primaryKey       = 'id_corousel';
    protected $allowedFields    = [
        'gambar',
        'link_to',
        'header',
    ];
}