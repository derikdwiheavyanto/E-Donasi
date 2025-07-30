<?php

namespace App\Controllers\Donatur;

use App\Controllers\BaseController;
use App\Models\DonasiModel;
use App\Models\UserModel;
use PHPUnit\Util\Json;

class HomeDonatur extends BaseController
{
    public function index()
    {


        $donasiModel = new DonasiModel();
        $userModel = model(UserModel::class);

        // Ambil ID user yang sedang login
        $id_donatur = user_id();
        $nama_user = $userModel->select('username')->find($id_donatur)->username;

        // Total donasi user ini
        $total_donasi = $donasiModel->getTotalDonasiByUser($id_donatur);
        $jumlah_transaksi = $donasiModel->getJumlahTransaksiDonasiByUser($id_donatur);
        $donasi_terakhir = $donasiModel->getDonasiTerakhirByUser($id_donatur);
        $donasi = $donasiModel->getRiwayatDonasiUser(user_id(), 'DESC', 5);


        // return view('menu/donatur/view_dashboard_donatur', [
        //     'title' => 'Selamat Datang ' . $nama_user,
        //     'total_donasi' => $total_donasi,
        //     'jumlah_transaksi' => $jumlah_transaksi,
        //     'donasi_terakhir' => $donasi_terakhir ?? ['nominal' => 0, 'tanggal_donasi' => 'Belum ada donasi'],
        //     'donasi' => $donasi
        // ]);

        return $this->response->setJSON([
            'title' => 'Selamat Datang ' . $nama_user,
            'total_donasi' => $total_donasi,
            'jumlah_transaksi' => $jumlah_transaksi,
            'donasi_terakhir' => $donasi_terakhir ?? ['nominal' => 0, 'tanggal_donasi' => 'Belum ada donasi'],
            'donasi' => $donasi
        ]);
    }
}
