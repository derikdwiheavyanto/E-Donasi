<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class LoginController extends BaseController
{
    public function index(): string
    {

        return view('login');
    }

   public function login() {
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    if ($username === 'admin' && $password === 'admin') {
        return redirect()->to('/dashboard');
    }

    if ($username === 'user' && $password === 'user') {
        return redirect()->to('/dashboard-donatur');
    }

    return redirect()->to('/');
}

}
