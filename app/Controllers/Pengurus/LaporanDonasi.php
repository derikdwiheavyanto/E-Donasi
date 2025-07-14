<?php

namespace App\Controllers\Pengurus;

use App\Controllers\BaseController;

class LaporanDonasi extends BaseController
{
    public function LaporanDonasi(): string
    {

        return view('menu/data_donatur/view-laporan', ['title' => 'Laporan Donasi']);
    }
}
