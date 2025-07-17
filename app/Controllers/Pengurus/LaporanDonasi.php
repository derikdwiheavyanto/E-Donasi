<?php

namespace App\Controllers\Pengurus;

use App\Controllers\BaseController;
use App\Models\DonasiModel;
use App\Models\PenggunaanDanaModel;
use Config\Services;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LaporanDonasi extends BaseController
{
    public function LaporanDonasi(): string
    {

        $bulan = $this->request->getGet('bulan') ?? date('m');
        $tahun = $this->request->getGet('tahun') ?? date('Y');

        $donasiModel = new DonasiModel();
        $penggunaanModel = new PenggunaanDanaModel();

        $total_donasi = $donasiModel->sumDonasiFiltered($bulan, $tahun);
        $total_pengeluaran = $penggunaanModel->sumPengeluaranFiltered($bulan, $tahun);


        $saldo = $total_donasi - $total_pengeluaran;
        $donasi = $donasiModel->filterDonasiByDate($bulan, $tahun)->paginate(5, 'donasi');
        $pengeluaran = $penggunaanModel->filterPengeluaranByDate($bulan, $tahun)->paginate(5, 'pengeluaran');

        $pager = Services::pager();

        $data = [
            'title' => 'Laporan Keuangan',
            'bulan' => $bulan,
            'tahun' => $tahun,
            'donasi' => $donasi,
            'pengeluaran' => $pengeluaran,
            'pager' => $pager,
            'total_donasi' => $total_donasi,
            'total_pengeluaran' => $total_pengeluaran,
            'saldo' => $saldo
        ];


        return view('menu/pengurus/data_donatur/view-laporan', $data);
    }
    public function exportExcel()
    {
        $bulan = $this->request->getGet('bulan') ?? date('m');
        $tahun = $this->request->getGet('tahun') ?? date('Y');

        $donasiModel = new DonasiModel();
        $penggunaanModel = new PenggunaanDanaModel();

        $donasi = $donasiModel->filterDonasiByDate($bulan, $tahun)->findAll();
        $pengeluaran = $penggunaanModel->filterPengeluaranByDate($bulan, $tahun)->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Laporan Donasi Bulan ' . $bulan . ' Tahun ' . $tahun);

        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'Nama Donatur');
        $sheet->setCellValue('C3', 'Tanggal Donasi');
        $sheet->setCellValue('D3', 'Nominal');

        $row = 4;
        $no = 1;
        foreach ($donasi as $d) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $d['nama_donatur']);
            $sheet->setCellValue('C' . $row, $d['tanggal_donasi']);
            $sheet->setCellValue('D' . $row, format_rupiah($d['nominal']));
            $row++;
        }

        $row++;

        $sheet->setCellValue('A' . $row, 'No');
        $sheet->setCellValue('B' . $row, 'Tanggal Pengeluaran');
        $sheet->setCellValue('C' . $row, 'Deskripsi');
        $sheet->setCellValue('D' . $row, 'Jumlah');
        $row++;

        $no = 1;
        foreach ($pengeluaran as $p) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $p['tanggal']);
            $sheet->setCellValue('C' . $row, $p['deskripsi']);
            $sheet->setCellValue('D' . $row, $p['jumlah']);
            $row++;
        }

        $filename = 'Laporan_Donasi_' . $bulan . '_' . $tahun . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }
}
