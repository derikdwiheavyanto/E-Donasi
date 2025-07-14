<?php

namespace App\Controllers\Pengurus;

use App\Controllers\BaseController;

class HomePengurus extends BaseController
{
    public function index(): string
    {

        return view('menu/dashboard/view_dashboard_layout', ['title' => 'Dashboard Pengurus']);
    }
}
