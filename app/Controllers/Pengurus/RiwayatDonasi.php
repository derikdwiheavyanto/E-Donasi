<?php

namespace App\Controllers\Pengurus;

use App\Controllers\BaseController;

class RiwayatDonasi extends BaseController
{
    public function RiwayatDonasi(): string
    {

        return view('home/pengurus/view_riwayat_donasi', ['title' => 'Riwayat Donasi']);
    }
}
