<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                "id" => 1,
                "name" => "pengurus",
                "description" => "Role Pengurus",
            ],
            [
                "id" => 2,
                "name" => "donatur",
                "description" => "Role Donatur",
            ]
        ];

        $this->db->table('auth_groups')->insertBatch($roles);
    }
}
