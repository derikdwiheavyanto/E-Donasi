<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class RedirectController extends BaseController
{
    public function index()
    {

        return redirect()->to('/login');
    }

    public function indexDashboard()
    {
        if (in_groups('pengurus')) {
            return redirect()->to('/pengurus/dashboard');
        } elseif (in_groups('donatur')) {
            return redirect()->to('/donatur/dashboard');
        }
        return redirect()->to('/logout')->with('error', 'Akses ditolak: role tidak dikenali.');
    }
}
