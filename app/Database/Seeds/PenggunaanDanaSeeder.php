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

        $imageFaker = [
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9SRRmhH4X5N2e4QalcoxVbzYsD44C-sQv-w&s',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTFYqoKTu_o3Zns2yExbst2Co84Gpc2Q1RJbA&s',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTc9APxkj0xClmrU3PpMZglHQkx446nQPG6lA&s',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ1zwhySGCEBxRRFYIcQgvOLOpRGqrT3d7Qng&s',
            'https://static.vecteezy.com/system/resources/thumbnails/057/068/323/small/single-fresh-red-strawberry-on-table-green-background-food-fruit-sweet-macro-juicy-plant-image-photo.jpg'
        ];

        $rows = [];
        for ($i = 0; $i < 20; $i++) {
            $tanggal = $faker->dateTimeThisYear()->format('Y-m-d');
            $deskripsi = $faker->randomElement($deskripsiFaker);
            $jumlah = $faker->numberBetween(100_000, 200_000);
            $bukti_foto = $faker->randomElement($imageFaker);
            $timestamp = $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d H:i:s');

            $rows[] = [
                'tanggal' => $tanggal,
                'deskripsi' => $deskripsi,
                'jumlah' => $jumlah,
                'bukti_foto' => $bukti_foto,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];
        }

        // masukkan sekaligus
        $this->db->table('penggunaan_dana')->insertBatch($rows);
    }
}
