<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class PenggunaanDanaSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');

        $deskripsiFaker = [
            'Pembelian alat tulis',
            'Biaya listrik dan air',
            'Pembelian bahan makanan',
            'Perawatan fasilitas',
            'Pengeluaran operasional harian',
            'Transportasi relawan',
            'Pembelian pakaian anak',
            'Pembayaran sekolah anak',
            'Pembelian perlengkapan mandi',
            'Kegiatan keagamaan dan pendidikan'
        ];

        $rows = [];
        for ($i = 0; $i < 20; $i++) {
            $tanggal = $faker->dateTimeThisYear()->format('Y-m-d');
            $deskripsi = $faker->randomElement($deskripsiFaker);
            $jumlah = $faker->numberBetween(100_000, 200_000);
            $timestamp = $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d H:i:s');

            $rows[] = [
                'tanggal' => $tanggal,
                'deskripsi' => $deskripsi,
                'jumlah' => $jumlah,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];
        }

        // masukkan sekaligus
        $this->db->table('penggunaan_dana')->insertBatch($rows);
    }
}
