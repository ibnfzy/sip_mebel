<?php

namespace App\Models;

use CodeIgniter\Model;

class OwnerModel extends Model
{
    protected $table            = 'owner';
    protected $primaryKey       = 'id_owner';
    protected $allowedFields    = [
        'username',
        'fullname',
        'password',
        'last_login',
    ];
}