<?php

namespace App\Controllers\Pengurus;

use App\Controllers\BaseController;

class HomePengurus extends BaseController
{
    public function index(): string
    {

        return view('menu/dashboard/pengurus/view_dashboard_pengurus', ['title' => 'Dashboard Pengurus']);
    }
}
