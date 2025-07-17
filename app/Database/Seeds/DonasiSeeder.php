<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class DonasiSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');

        $userModel = new UserModel();

        $user = $userModel->select('id')->where('id !=', 1)->findAll();
        $userIds = array_column($user, 'id');



        for ($i = 0; $i < 20; $i++) {
            $data = [
                'id_donatur' => $faker->randomElement($userIds),
                'tanggal_donasi' => $faker->dateTimeBetween('2025-02-01', 'now')->format('Y-m-d'),
                'nominal' => $faker->numberBetween(50000, 1000000),
                'keterangan' => $faker->randomElement(['Donasi rutin', 'Bantuan bencana', 'Santunan yatim']),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $this->db->table('donasi')->insert($data);
        }
    }
}
