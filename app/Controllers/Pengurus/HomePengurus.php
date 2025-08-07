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
        $user = model(UserModel::class);
        $donasi = model(DonasiModel::class);
        $penggunaan_dana = model(PenggunaanDanaModel::class);

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


        return view('menu/pengurus/dashboard/view_dashboard_pengurus', ['title' => 'Dashboard Pengurus', 'data' => $data]);
    }

    public function store()
    {
        $penggunaan = new PenggunaanDanaModel();

        $file = $this->request->getFile('bukti_foto');
        $buktiFotoName = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $buktiFotoName = $file->getRandomName();
            $file->move('uploads/bukti_penggunaan', $buktiFotoName);
        }

        $penggunaan->insert([
            'tanggal'    => $this->request->getPost('tanggal'),
            'deskripsi'  => $this->request->getPost('deskripsi'),
            'jumlah'     => $this->request->getPost('jumlah'),
            'bukti_foto' => $buktiFotoName,
        ]);

        return redirect()->back()->with('success', 'Data penggunaan dana berhasil disimpan.');
    }
}
