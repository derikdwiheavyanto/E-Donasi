<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaanDanaModel extends Model
{
    protected $table = 'penggunaan_dana';
    protected $primaryKey = 'id_penggunaan';
    protected $allowedFields = ['tanggal', 'deskripsi', 'jumlah', 'bukti_foto'];
    protected $useTimestamps = true;


    public function getSumPengeluaran()
    {
        return $this->selectSum('jumlah')->get()->getRow()->jumlah;
    }

    public function getKeterangan($start = null, $end = null, $direction= 'DESC')
    {
        if ($start && $end) {
            $row = $this->select('tanggal, deskripsi, jumlah, bukti_foto')
                ->where('tanggal >=', $start)
                ->where('tanggal <=', $end)
                ->orderBy('tanggal', $direction)
                ->orderBy('created_at', 'DESC');

            return $row;
        }
        
        return $this->select('tanggal, deskripsi, jumlah, bukti_foto')->orderBy('tanggal', $direction)->orderBy('created_at', 'DESC');
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
            ->where('YEAR(tanggal)', $tahun) -> orderBy( 'tanggal', 'DESC');
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
    public function getPenggunaanPerBulan($start = null, $end = null) {
    $builder = $this->builder();
    $builder->select("DATE_FORMAT(tanggal, '%M %Y') as bulan, SUM(jumlah) as total");
    if ($start && $end) {
        $builder->where('tanggal >=', $start);
        $builder->where('tanggal <=', $end);
    }
    $builder->groupBy('bulan');
    $builder->orderBy('MIN(tanggal)');

    $result = [];
    foreach ($builder->get()->getResultArray() as $row) {
        $result[$row['bulan']] = (int)$row['total'];
    }
    return $result;
}

}
