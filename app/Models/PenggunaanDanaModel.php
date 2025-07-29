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

    public function getKeterangan($start = null, $end = null)
    {
        if ($start && $end) {
            $row = $this->select('tanggal, deskripsi, jumlah, bukti_foto')
                ->where('tanggal >=', $start)
                ->where('tanggal <=', $end);

            return $row;
        }
        
        return $this->select('tanggal, deskripsi, jumlah, bukti_foto');
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

    public function getTotalDanaTerpakai($start = null, $end = null)
    {
        $builder = $this->selectSum('jumlah');

        if ($start && $end) {
            $builder->where('tanggal >=', $start);
            $builder->where('tanggal <=', $end);
        }

        $result = $builder->get()->getRow();
        return $result->jumlah ?? 0;
    }
}
