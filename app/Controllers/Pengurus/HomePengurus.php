<?php

namespace App\Controllers\Pengurus;

use App\Controllers\BaseController;

class HomePengurus extends BaseController
{
    public function index(): string
    {

        return view('home/pengurus/view_dashboard_pengurus', ['title' => 'Dashboard Pengurus']);
    }
    
    public function indexDonatur()  {
        return view('home/donatur/view_dashboard_donatur', ['title' => 'Dashboard Donatur']);
    }
}
