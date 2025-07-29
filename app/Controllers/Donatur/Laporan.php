<?php

namespace App\Controllers\Donatur;

use App\Controllers\BaseController;
use App\Models\DonasiModel;
use App\Models\PenggunaanDanaModel;
use App\Models\UserModel;

class Laporan extends BaseController
{

    public function index(): string
    {

        $start = $this->request->getGet('start');
        $end = $this->request->getGet('end');

        $donasi = new DonasiModel();
        $penggunaan = new PenggunaanDanaModel();
        $user = new UserModel();

        // Default nilai
        $total_donasi_masuk = 0;
        $total_donasi_terpakai = 0;

        if ($start && $end) {
            // Total donasi masuk berdasarkan tanggal
            $total_donasi_masuk = $donasi->where('tanggal_donasi >=', $start)
                ->where('tanggal_donasi <=', $end)
                ->selectSum('nominal')
                ->first()['nominal'] ?? 0;

            // Total donasi terpakai berdasarkan tanggal_donasi
            $total_donasi_terpakai = $penggunaan->where('tanggal >=', $start)
                ->where('tanggal <=', $end)
                ->selectSum('jumlah')
                ->first()['jumlah'] ?? 0;

            $data_penggunaan = $penggunaan->getKeterangan($start, $end) -> paginate(5, 'penggunaan');

        } else {
            // Jika tidak ada filter tanggal, ambil semua
            $total_donasi_masuk = $donasi->selectSum('nominal')->first()['nominal'] ?? 0;
            $total_donasi_terpakai = $penggunaan->getTotalDanaTerpakai();
            $data_penggunaan = $penggunaan->getKeterangan() -> paginate(5, 'penggunaan');
        }

        $sisa_dana = $total_donasi_masuk - $total_donasi_terpakai;
        $jumlah_user = $user->getJumlahUser();

        $persentase_terpakai = 0;
        if ($total_donasi_masuk > 0) {
            $persentase_terpakai = ($total_donasi_terpakai / $total_donasi_masuk) * 100;
        }

        return view('menu/donatur/view_laporan_donatur', [
            'total_donasi_masuk' => $total_donasi_masuk,
            'total_donasi_terpakai' => $total_donasi_terpakai,
            'sisa_dana' => $sisa_dana,
            'jumlah_user' => $jumlah_user,
            'persentase_terpakai' => floor($persentase_terpakai),
            'start' => $start,
            'end' => $end,
            'penggunaan' => $data_penggunaan,
            'pager' => $penggunaan->pager
        ]);
    }
}
