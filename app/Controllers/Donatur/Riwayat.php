<?php

namespace App\Controllers\Donatur;

use App\Controllers\BaseController;

class Riwayat extends BaseController
{
    public function index(): string
    {

        return view('menu/dashboard/donatur/view_riwayat_donatur', ['title' => 'Riwayat Donatur']);
    }
}
