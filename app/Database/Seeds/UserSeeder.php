<?php

namespace App\Database\Seeds;

use App\Entities\User;
use App\Models\UserModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');
        $userModel = new UserModel();

        for ($i = 0; $i < 10; $i++) {
            $userModel->withGroup('donatur')->save($userModel->fake($faker));
        }
        // $user = new User([
        //     'password' => '123456',
        // ]);
        // $userModel->update(46, $user);
    }
}
