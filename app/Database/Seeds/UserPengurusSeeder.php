<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Entities\User;
use App\Models\UserModel;
use Myth\Auth\Models\GroupModel;

class UserPengurusSeeder extends Seeder
{
    public function run()
    {
        $users = new UserModel();

        $user = new User([
            'username' => 'pengurus',
            'email' => 'pengurus@gmail.com',
            'password' => 'pengurus',
            'active' => 1
        ]);

        $users->save($user);

        $userId = $users->getInsertID();

        $group = new GroupModel();
        $group->addUserToGroup($userId, 1);
    }
}
