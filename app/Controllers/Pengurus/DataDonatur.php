<?php

namespace App\Controllers\Pengurus;

use App\Controllers\BaseController;

class DataDonatur extends BaseController
{
    public function index(): string
    {

        return view('home/pengurus/view-data-donatur', ['title' => 'Data Donatur']);
    }
}
