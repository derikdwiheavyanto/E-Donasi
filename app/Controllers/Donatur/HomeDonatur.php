<?php

namespace App\Controllers\Donatur;

use App\Controllers\BaseController;
use App\Models\DonasiModel;

class HomeDonatur extends BaseController
{
    public function index(): string
    {


        $donasiModel = new DonasiModel();

        // Ambil ID user yang sedang login
        $id_donatur = user_id(); // pastikan sudah pakai shield/auth

        // Total donasi user ini
        $total_donasi = $donasiModel->getTotalDonasiByUser($id_donatur);
        $jumlah_transaksi = $donasiModel->getJumlahTransaksiDonasiByUser($id_donatur);
        $donasi_terakhir = $donasiModel->getDonasiTerakhirByUser($id_donatur);
        $donasi = $donasiModel->getRiwayatDonasiUser(user_id(),'DESC',5);


        return view('menu/dashboard/donatur/view_dashboard_donatur', [
            'title' => 'Dashboard Donatur',
            'total_donasi' => $total_donasi,
            'jumlah_transaksi' => $jumlah_transaksi,
            'donasi_terakhir' => $donasi_terakhir,
            'donasi' => $donasi
        ]);
    }
}
