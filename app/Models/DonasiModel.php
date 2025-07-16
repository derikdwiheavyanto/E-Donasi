<?php

namespace App\Models;

use CodeIgniter\Model;

class DonasiModel extends Model
{
    protected $table = 'donasi';
    protected $primaryKey = 'id_donasi';

    public function sumDonasi()
    {
        $total_donasi = $this->selectSum('nominal')->get()->getRow()->nominal;

        return $total_donasi;
    }

    public function sumDonasiFiltered($bulan, $tahun)
    {
        return $this->selectSum('nominal')
            ->where('MONTH(tanggal_donasi)', $bulan)
            ->where('YEAR(tanggal_donasi)', $tahun)
            ->get()
            ->getRow()
            ->nominal ?? 0;
    }
    public function getDonasiTerbaru($limit = 5)
    {
        return $this->select('users.username as nama_donatur, donasi.tanggal_donasi, donasi.nominal')
            ->join('users', 'users.id = donasi.id_donatur')
            ->orderBy('tanggal_donasi', 'desc')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }

    public function getTrendDonasi()
    {
        return $this->select("DATE_FORMAT(tanggal_donasi,'%Y-%m') as bulan, SUM(nominal) as total_donasi_per_bulan")
            ->where('tanggal_donasi >=', date('Y-m-01', strtotime('-5 months')))
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->findAll();
    }

    public function filterDonasiByDate($bulan, $tahun)
    {
        return $this->select('donasi.*, users.username as nama_donatur')
            ->join('users', 'users.id = donasi.id_donatur')
            ->where('MONTH(tanggal_donasi)', $bulan)
            ->where('YEAR(tanggal_donasi)', $tahun);
    }

}
