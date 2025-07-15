<?php

namespace App\Controllers\Donatur;

use App\Controllers\BaseController;

class InginDonasi extends BaseController
{
    public function index(): string
    {

        return view('menu/dashboard/donatur/view_ingin_donasi', ['title' => 'Formulir Donasi']);
    }
}
