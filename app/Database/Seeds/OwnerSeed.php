<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OwnerSeed extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'wulan',
            'fullname' => 'Wulan',
            'password' => password_hash('wulan', PASSWORD_DEFAULT),
            'last_login' => date('D-m-y'),
        ];

        $this->db->table('owner')->insert($data);
    }
}
