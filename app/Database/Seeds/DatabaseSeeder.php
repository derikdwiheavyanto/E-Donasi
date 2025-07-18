<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        $this->call("RoleSeeder");
        $this->call("UserPengurusSeeder");
        
    }
}
