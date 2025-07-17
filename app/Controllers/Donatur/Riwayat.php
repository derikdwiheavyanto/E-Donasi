<?php

namespace App\Controllers\Donatur;

use App\Controllers\BaseController;
use App\Models\DonasiModel;

class Riwayat extends BaseController
{
    public function index(): string
    {
         $donasiModel = model(DonasiModel::class);

        $donasi = $donasiModel->getRiwayatDonasiUser(user_id());

        return view('menu/dashboard/donatur/view_riwayat_donatur', ['title' => 'Riwayat Donatur', 'donasi' => $donasi]);
    }
}
