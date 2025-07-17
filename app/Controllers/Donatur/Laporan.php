<?php

namespace App\Controllers\Donatur;

use App\Controllers\BaseController;

class Laporan extends BaseController
{
    public function index(): string
    {

        return view('menu/donatur/view_laporan_donatur', ['title' => 'Laporan Donatur']);
    }
}
