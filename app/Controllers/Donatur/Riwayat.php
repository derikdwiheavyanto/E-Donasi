<?php

namespace App\Controllers\Donatur;

use App\Controllers\BaseController;
use App\Models\DonasiModel;
use Config\Midtrans;
use Config\Services;
use Midtrans\ApiRequestor;
use Midtrans\Transaction;

class Riwayat extends BaseController
{
    /**
     * Menampilkan halaman riwayat donasi untuk user yang sedang login.
     *
     * Fungsi ini melakukan beberapa hal:
     * 1. Inisialisasi Midtrans untuk mengambil status transaksi terbaru.
     * 2. Mengambil seluruh riwayat donasi user dari database.
     * 3. Jika status donasi belum "settlement", maka akan dicek ulang ke Midtrans.
     * 4. Jika status dari Midtrans berbeda dengan yang ada di database, maka status dan metode pembayaran akan diperbarui.
     * 5. Menyusun data riwayat donasi yang akan ditampilkan ke view.
     *
     * @return string View halaman riwayat donatur.
     */
    public function index(): string
    {
        // Inisialisasi Midtrans (server key, mode produksi/sandbox, dll)
        Midtrans::init();

        $donasiModel = model(DonasiModel::class);

        // Ambil data riwayat donasi user yang sedang login
        $donasi = $donasiModel->getRiwayatDonasiUser(user_id(), "DESC", null, 10, "riwayat_donasi");

        $data = [];

        foreach ($donasi as $d) {
            /**
             * @var \stdClass $status
             */
            $status;


            // Cek status ke Midtrans jika belum settlement dan jika tidak expire
            if ($d["status"] !== "settlement" && $d["status"] !== "expire") {
                /**
                 * @var \stdClass $status
                 */
                $status = Transaction::status($d['order_id']);

                // Update status di database jika berbeda
                if ($d['status'] !== $status->transaction_status) {
                    $donasiModel->update($d['id_donasi'], [
                        'status' => $status->transaction_status,
                        'pembayaran' => $status->payment_type,
                    ]);
                }
            }


            // Susun data untuk dikirim ke view
            $data[] = [
                "order_id" => $d["order_id"],
                "id_donatur" => $d["id_donatur"],
                "tanggal_donasi" => $d["tanggal_donasi"],
                "nominal" => $d["nominal"],
                "pembayaran" => $status->payment_type ?? $d["pembayaran"],
                "status" => $status->transaction_status ?? $d["status"],
            ];
        }

        $pager = Services::pager();

        return view('menu/donatur/view_riwayat_donatur', [
            'title' => 'Riwayat Donatur',
            'donasi' => $data,
            'pager' => $pager
        ]);
    }
}
