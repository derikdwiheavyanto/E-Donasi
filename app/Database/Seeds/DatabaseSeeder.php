<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        $faker = Factory::create('id_ID');
        // $this->call("RoleSeeder");
        // $this->call("UserPengurusSeeder");
        $userModel = new UserModel();

        for ($i = 0; $i < 10; $i++) {
            $userModel->withGroup('donatur')->save($userModel->fake($faker));
        }
    }
}
