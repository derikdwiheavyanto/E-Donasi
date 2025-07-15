<?php

namespace App\Controllers\Pengurus;

use App\Controllers\BaseController;
use App\Models\DonasiModel;
use App\Models\PenggunaanDanaModel;
use App\Models\UserModel;

class HomePengurus extends BaseController
{
    public function index(): string
    {
        $user = new UserModel;
        $donasi = new DonasiModel();
        $penggunaan_dana = new PenggunaanDanaModel();

        $data = [];

        $data['jumlah_donatur'] = $user->countDonatur();
        $data['total_donasi'] = $donasi->sumDonasi();
        $data['total_pengeluaran'] = $penggunaan_dana->getSumPengeluaran();
        $data['dana_saat_ini'] = $data['total_donasi'] - $data['total_pengeluaran'];
        $data['data_donasi_terbaru'] = $donasi->getDonasiTerbaru();

        $data_donasi = $donasi->getTrendDonasi();
        $labels = [];
        $values = [];

        foreach ($data_donasi as $row) {
            $labels[] = date('M', strtotime($row['bulan']));
            $values[] = $row['total_donasi_per_bulan'];
        }

        $data['data_trend_donasi'] = [
            'chart_labels' => json_encode($labels),
            'chart_values' => json_encode($values)
        ];


        return view('menu/dashboard/pengurus/view_dashboard_pengurus', ['title' => 'Dashboard Pengurus', 'data' => $data]);
    }

    public function getDashboardPengurus(): string
    {

        $user = new UserModel;

        $data = [];

        $data['jumlah_donatur'] = $user->where('role', 'donatur')->countAllResults();


        return view('menu/dashboard/donatur/view_dashboard_donatur', ['title' => 'Dashboard Donatur', 'data' => $data]);
    }
}
