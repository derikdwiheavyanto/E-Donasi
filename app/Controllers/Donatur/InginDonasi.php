<?php

namespace App\Controllers\Donatur;

use App\Controllers\BaseController;
use App\Models\DonasiModel;
use App\Models\UserModel;
use Config\Midtrans;
use Midtrans\Snap;

class InginDonasi extends BaseController
{
    public function index(): string
    {




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

    public function payment()
    {

        Midtrans::init();

        $user = model(UserModel::class);
        $user = $user->find(user_id());

        $nominal = $this->request->getPost('nominal');
        $pembayaran = $this->request->getPost('pembayaran');




        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => $nominal  ,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);


        return view('menu/donatur/payment/embed_payment', ['snap_token' => $snapToken, 'nominal' => $nominal, 'pembayaran' => $pembayaran]);
    }
}
