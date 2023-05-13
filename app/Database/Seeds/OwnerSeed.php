<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OwnerSeed extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'nila',
            'fullname' => 'Nila',
            'password' => password_hash('nila', PASSWORD_DEFAULT),
            'last_login' => date('D-m-y')
        ];

        $this->db->table('pemilik')->insert($data);
    }
}
