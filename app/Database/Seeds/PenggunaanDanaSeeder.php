<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class PenggunaanDanaSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');

        $rows  = [];
        for ($i = 0; $i < 20; $i++) {
            // ambil tanggal acak di tahun berjalan
            $tanggal   = $faker->dateTimeThisYear()->format('Y-m-d');
            // satu kalimat (±6 kata) sebagai deskripsi
            $deskripsi = $faker->sentence(6, true);
            // nominal rupiah 100 000 – 2 000 000
            $jumlah    = $faker->numberBetween(100_000, 200_000);
            $timestamp = $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d H:i:s');

            $rows[] = [
                'tanggal'    => $tanggal,
                'deskripsi'  => $deskripsi,
                'jumlah'     => $jumlah,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];
        }

        // masukkan sekaligus
        $this->db->table('penggunaan_dana')->insertBatch($rows);
    }
}
