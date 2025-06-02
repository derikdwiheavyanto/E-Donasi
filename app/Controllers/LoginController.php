<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class LoginController extends BaseController
{
    public function halamanpertama(): string
    {

        return view('login');
    }
}
