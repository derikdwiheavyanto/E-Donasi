<?php

namespace App\Controllers\Pengurus;

use App\Controllers\BaseController;

class DataDonatur extends BaseController
{
    public function index(): string
    {

        return view('menu/data_donatur/view-data-donatur', ['title' => 'Data Donatur']);
    }
}
