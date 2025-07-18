<?php

namespace App\Controllers\Donatur;

use App\Controllers\BaseController;
use App\Models\DonasiModel;
use App\Models\UserModel;
use Config\Midtrans;
use Midtrans\Snap;
use Midtrans\Transaction;

class InginDonasi extends BaseController
{
    public function index(): string
    {
        return view('menu/donatur/view_ingin_donasi', ['title' => 'Formulir Donasi']);
    }

    public function create()
    {


        Midtrans::init();

        $donasi = model(DonasiModel::class);
        $order_id = $this->request->getPost('order_id');
        $snap_token = $this->request->getPost('snap_token');
        /** @var \stdClass $status */
        $status = Transaction::status($order_id);
        $donasi->save([
            'id_donatur' => user_id(),
            'order_id' => $order_id,
            'tanggal_donasi' => date('Y-m-d'),
            'nominal' => $this->request->getPost('nominal'),
            'status' => $status->transaction_status,
            'pembayaran' => $status->payment_type
        ]);

        return redirect()->to('/donatur/riwayat-donatur')->with('success', 'Donasi berhasil disimpan!');
    }

    public function payment()
    {

        Midtrans::init();

        $user = model(UserModel::class);
        $user = $user->find(user_id());

        $nominal = $this->request->getPost('nominal');


        $order_id = rand();

        $params = [
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $nominal,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);


        return view(
            'menu/donatur/payment/embed_payment',
            [
                'snap_token' => $snapToken,
                'nominal' => $nominal,
                'order_id' => $order_id
            ]
        );
    }
}
