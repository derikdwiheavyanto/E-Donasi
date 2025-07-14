<?php

namespace App\Controllers\Pengurus;

use App\Controllers\BaseController;

class LaporanDonasi extends BaseController
{
    public function LaporanDonasi(): string
    {

        return view('home/pengurus/view-laporan', ['title' => 'Laporan Donasi']);
    }
}
