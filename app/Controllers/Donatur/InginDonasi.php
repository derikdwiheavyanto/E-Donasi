<?php

namespace App\Controllers\Donatur;

use App\Controllers\BaseController;
use App\Models\DonasiModel;

class InginDonasi extends BaseController
{
    public function index(): string
    {
        $donasi = model(DonasiModel::class);

        $donasi = $donasi->getRiwayatDonasiUser(user_id());



        return view('menu/donatur/view_ingin_donasi', ['title' => 'Formulir Donasi']);
    }

    public function create()
    {

        $donasi = model(DonasiModel::class);
        $donasi->save([
            'id_donatur' => user_id(),
            'tanggal_donasi' => date('Y-m-d'),
            'nominal' => $this->request->getPost('nominal'),
            'pembayaran' => $this->request->getPost('pembayaran'),
        ]);

        return redirect()->to('/donatur/riwayat-donatur')->with('success', 'Donasi berhasil disimpan!');
    }
}
