<?php

namespace App\Controllers\Donatur;

use App\Controllers\BaseController;

class Laporan extends BaseController
{
    public function index(): string
    {

        return view('menu/dashboard/donatur/view_laporan_donatur', ['title' => 'Laporan Donatur']);
    }
}
