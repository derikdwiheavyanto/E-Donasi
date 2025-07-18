<?php

namespace App\Models;

use CodeIgniter\Model;

class DonasiModel extends Model
{
    protected $table = 'donasi';
    protected $primaryKey = 'id_donasi';
    protected $allowedFields = [
        'id_donatur',
        'order_id',
        'tanggal_donasi',
        'nominal',
        'keterangan',
        'pembayaran',
        'status'
    ];
    protected $useTimestamps = true;

    /**
     * Mengambil total nominal donasi dari seorang donatur berdasarkan ID-nya.
     *
     * Method ini akan menjumlahkan seluruh nilai donasi (`nominal`) yang dilakukan oleh
     * donatur dengan ID yang diberikan. Jika tidak ditemukan data, maka akan mengembalikan 0.
     *
     * @param int|string $id_donatur ID dari donatur yang ingin dihitung total donasinya.
     * @return int Total donasi dalam satuan nominal. Jika tidak ada data, nilai default adalah 0.
     */
    public function getTotalDonasiByUser($id_donatur)
    {
        return $this->where('id_donatur', $id_donatur)
            ->selectSum('nominal')
            ->first()['nominal'] ?? 0;
    }

    /**
     * Mengambil jumlah transaksi donasi dari seorang donatur berdasarkan ID-nya.
     * 
     * Method ini akan menghitung jumlah transaksi donasi yang dilakukan 
     * oleh donatur dengan ID yang diberikan.
     * @param string|int $id_donatur
     * @return int|string
     */
    public function getJumlahTransaksiDonasiByUser($id_donatur)
    {
        return $this->where('id_donatur', $id_donatur)->countAllResults();
    }

    /**
     * Mengambil data donasi terakhir (paling baru) dari seorang donatur berdasarkan ID-nya.
     *
     * Method ini akan mengambil satu data donasi terbaru berdasarkan field `created_at` 
     * secara menurun (DESC). Cocok digunakan untuk menampilkan riwayat donasi terakhir 
     * yang dilakukan oleh donatur tertentu.
     *
     * @param int|string $id_donatur ID dari donatur yang ingin diambil data donasi terakhirnya.
     * @return array|object|null Data donasi terakhir berupa array atau object, atau null jika tidak ditemukan.
     */
    public function getDonasiTerakhirByUser($id_donatur)
    {
        return $this->where('id_donatur', $id_donatur)
            ->orderBy('created_at', 'DESC')
            ->first(); // Ambil 1 data terbaru
    }


    /**
     * Mengambil daftar riwayat donasi berdasarkan ID user (donatur).
     *
     * Method ini akan mengembalikan daftar donasi yang dilakukan oleh user 
     * tertentu, dengan urutan berdasarkan tanggal pembuatan (`created_at`). 
     * Bisa dibatasi jumlah hasilnya dan diatur arah pengurutan (ASC/DESC).
     *
     * @param int|string $user_id ID user (donatur) yang ingin diambil data riwayat donasinya.
     * @param string $direction Urutan hasil berdasarkan waktu donasi. Nilai yang diterima: 'ASC' atau 'DESC'. Default: 'ASC'.
     * @param int|null $limit Jumlah maksimum data donasi yang dikembalikan. Jika null, semua data dikembalikan.
     * @return array|null Daftar riwayat donasi dalam bentuk array, null jika data tidak ditemukan.
     */
    public function getRiwayatDonasiUser($user_id, $dircetion = "ASC", $limit = null, $paginate = null, $paginate_group = "")
    {
        return $this->where('id_donatur', $user_id)->limit($limit)->orderBy('created_at', $dircetion)->paginate($paginate, $paginate_group);
    }

    /**
     * Menghitung total keseluruhan nominal donasi yang tercatat di dalam database.
     *
     * Metode ini menggunakan `selectSum` untuk menjumlahkan semua nilai pada kolom `nominal`
     * dalam tabel donasi. Hasilnya dikembalikan sebagai bilangan bulat.
     *
     * @return int Total keseluruhan donasi. Akan mengembalikan 0 jika tidak ada data.
     */
    public function sumDonasi()
    {
        $total_donasi = $this->selectSum('nominal')->get()->getRow()->nominal;

        return $total_donasi;
    }

    /**
     * Menghitung total nominal donasi berdasarkan bulan dan tahun tertentu.
     *
     * Metode ini menjumlahkan seluruh nilai pada kolom `nominal` dalam tabel donasi,
     * yang sesuai dengan bulan dan tahun yang diberikan.
     *
     * @param int $bulan Bulan dalam format numerik (1–12).
     * @param int $tahun Tahun dalam format 4 digit (misal: 2025).
     * @return int Total nominal donasi pada bulan dan tahun yang ditentukan, 
     *             atau 0 jika tidak ditemukan data.
     */
    public function sumDonasiFiltered($bulan, $tahun)
    {
        return $this->selectSum('nominal')
            ->where('MONTH(tanggal_donasi)', $bulan)
            ->where('YEAR(tanggal_donasi)', $tahun)
            ->get()
            ->getRow()
            ->nominal ?? 0;
    }

    /**
     * Mengambil data donasi terbaru dari database.
     *
     * Fungsi ini mengambil data donasi terbaru berdasarkan tanggal donasi secara menurun,
     * dan menggabungkan (join) data dari tabel `users` untuk menampilkan nama donatur.
     *
     * @param int $limit Jumlah maksimal data donasi yang akan diambil. Default 5.
     * @return array Daftar data donasi terbaru berupa array asosiatif berisi nama donatur,
     *               tanggal donasi, dan nominal.
     */
    public function getDonasiTerbaru($limit = 5)
    {
        return $this->select('users.name as nama_donatur, donasi.tanggal_donasi, donasi.nominal')
            ->join('users', 'users.id = donasi.id_donatur')
            ->orderBy('tanggal_donasi', 'desc')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }

    /**
     * Mengambil tren donasi bulanan selama 6 bulan terakhir.
     *
     * Fungsi ini mengambil data total donasi per bulan dari 6 bulan terakhir,
     * dimulai dari awal bulan lima bulan yang lalu hingga bulan ini.
     * Data dikelompokkan berdasarkan bulan (format YYYY-MM) dan diurutkan secara menaik.
     *
     * @return array Daftar array asosiatif berisi:
     *               - 'bulan' (string): Format YYYY-MM.
     *               - 'total_donasi_per_bulan' (int): Total nominal donasi pada bulan tersebut.
     */
    public function getTrendDonasi()
    {
        return $this->select("DATE_FORMAT(tanggal_donasi,'%Y-%m') as bulan, SUM(nominal) as total_donasi_per_bulan")
            ->where('tanggal_donasi >=', date('Y-m-01', strtotime('-5 months')))
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->findAll();
    }

    /**
     * Memfilter data donasi berdasarkan bulan dan tahun tertentu.
     * 
     * Fungsi ini menghasilkan query builder untuk mengambil data donasi
     * yang terjadi pada bulan dan tahun tertentu, termasuk nama donatur
     * dari tabel users.
     *
     * @param int $bulan Bulan (1–12) yang ingin difilter.
     * @param int $tahun Tahun (misal: 2025) yang ingin difilter.
     * @return DonasiModel Query builder yang siap dieksekusi (misal ->findAll()).
     */
    public function filterDonasiByDate($bulan, $tahun)
    {
        return $this->select('donasi.*, users.name as nama_donatur')
            ->join('users', 'users.id = donasi.id_donatur')
            ->where('MONTH(tanggal_donasi)', $bulan)
            ->where('YEAR(tanggal_donasi)', $tahun);
    }
}
