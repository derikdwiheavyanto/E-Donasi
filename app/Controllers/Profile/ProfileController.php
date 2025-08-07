<?php

namespace App\Controllers\Profile;

use App\Controllers\BaseController;
use App\Entities\User;
use App\Models\DonasiModel;
use App\Models\UserModel;

class ProfileController extends BaseController
{
    protected $userModel;
    protected $donasiModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->donasiModel = new DonasiModel();
    }

    public function index()
    {
        $userId = user_id(); 
        if (!$userId) {
            return redirect()->to('/login');
        }

        // Ambil data user
        $user = $this->userModel->find($userId);

        // Hitung total donasi
        $totalDonasi = $this->donasiModel
            ->where('id_donatur', $userId)
            ->selectSum('nominal')
            ->first()['nominal'] ?? 0;

        // Ambil donasi terakhir
        $donasiTerakhir = $this->donasiModel
            ->where('id_donatur', $userId)
            ->orderBy('created_at', 'DESC')
            ->first();

        return view('profile/view_profile', [
            'title' => 'Profil Saya',
            'user' => $user,
            'totalDonasi' => $totalDonasi,
            'donasiTerakhir' => $donasiTerakhir
        ]);
    }
    public function update()
    {
        $userId = user_id(); // Ambil ID user yang sedang login

        $data = [
            'id'       => $userId,
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'phone'    => $this->request->getPost('phone'),
            'address'  => $this->request->getPost('address'),
        ];

        // Hanya update password jika diisi
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = $password;
        }

        $user = new User();
        $user->fill($data);

        if ($this->userModel->save($user)) {
            return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
        }

        $errors = $this->userModel->errors();
        
        return redirect()->back()->withInput()->with('errors', $errors);
    }
}
