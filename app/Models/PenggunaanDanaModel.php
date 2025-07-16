<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaanDanaModel extends Model
{
    protected $table = 'penggunaan_dana';
    protected $primaryKey = 'id_penggunaan';


    public function getSumPengeluaran()
    {
        return $this->selectSum('jumlah')->get()->getRow()->jumlah;
    }

    public function sumPengeluaranFiltered($bulan, $tahun)
    {
        return $this->selectSum('jumlah')
            ->where('MONTH(tanggal)', $bulan)
            ->where('YEAR(tanggal)', $tahun)
            ->get()
            ->getRow()
            ->jumlah ?? 0;
    }

    public function filterPengeluaranByDate($bulan, $tahun)
    {
        return $this->where('MONTH(tanggal)', $bulan)
            ->where('YEAR(tanggal)', $tahun);
    }
}
