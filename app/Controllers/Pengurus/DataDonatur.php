<?php

namespace App\Controllers\Pengurus;

use App\Controllers\BaseController;
use App\Models\UserModel;

class DataDonatur extends BaseController
{
    public function index(): string
    {
        $user = new UserModel;
        return view('menu/data_donatur/view-data-donatur', ['title' => 'Data Donatur', 'user' => $user->findDonatur()]);
    }
}
