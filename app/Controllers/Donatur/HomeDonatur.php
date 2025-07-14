<?php

namespace App\Controllers\Donatur;

use App\Controllers\BaseController;

class HomeDonatur extends BaseController
{
    public function index(): string
    {

        return view('menu/dashboard/donatur/view_dashboard_donatur', ['title' => 'Dashboard Donatur']);
    }
}
