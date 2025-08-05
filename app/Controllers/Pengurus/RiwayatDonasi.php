<?php

namespace App\Controllers\Pengurus;

use App\Controllers\BaseController;
use App\Models\DonasiModel;

class RiwayatDonasi extends BaseController
{
    public function RiwayatDonasi(): string
    {
        $donasiModel = new DonasiModel();
        $data = [
            'title' => 'Riwayat Donasi',
            'donasi' => $donasiModel->getAllDonasiWithUser(), // ambil semua donasi lengkap
        ];


        return view('menu/pengurus/data_donatur/view_riwayat_donasi', $data);
    }
    public function delete($id)
    {
        $donasiModel = new DonasiModel();
        $donasiModel->delete($id);

        return redirect()->to(base_url('pengurus/riwayat-donasi'))->with('success', 'Data berhasil dihapus');
    }
}
