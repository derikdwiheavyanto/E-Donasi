<?php

namespace App\Models;

use CodeIgniter\Model;

class DonasiModel extends Model
{
    protected $table = 'donasi';
    protected $primaryKey = 'id_donasi';
    protected $allowedFields = ['id_donatur', 'tanggal_donasi', 'nominal', 'pembayaran'];
    protected $useTimestamps = true;


    public function getTotalDonasiByUser($id_donatur)
    {
        return $this->where('id_donatur', $id_donatur)
            ->selectSum('nominal')
            ->first()['nominal'] ?? 0;
    }

    // app/Models/DonasiModel.php

    public function getJumlahTransaksiDonasiByUser($id_donatur)
    {
        return $this->where('id_donatur', $id_donatur)->countAllResults();
    }

    // app/Models/DonasiModel.php

    public function getDonasiTerakhirByUser($id_donatur)
    {
        return $this->where('id_donatur', $id_donatur)
            ->orderBy('created_at', 'DESC')
            ->first(); // Ambil 1 data terbaru
    }



    public function getRiwayatDonasiUser($user_id, $dircetion = "ASC",$limit = null)
    {
        return $this->where('id_donatur', $user_id)->limit($limit)->orderBy('created_at', $dircetion)->findAll();
    }

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
        return $this->select('users.name as nama_donatur, donasi.tanggal_donasi, donasi.nominal')
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
        return $this->select('donasi.*, users.name as nama_donatur')
            ->join('users', 'users.id = donasi.id_donatur')
            ->where('MONTH(tanggal_donasi)', $bulan)
            ->where('YEAR(tanggal_donasi)', $tahun);
    }
}
