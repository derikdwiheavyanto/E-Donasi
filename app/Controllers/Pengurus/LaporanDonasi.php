<?php

namespace App\Controllers\Pengurus;

use App\Controllers\BaseController;
use App\Models\DonasiModel;
use App\Models\PenggunaanDanaModel;
use Config\Services;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class LaporanDonasi extends BaseController
{
    /**
     * Menampilkan halaman laporan keuangan donasi dan pengeluaran bulanan.
     *
     * Fungsi ini mengambil data bulan dan tahun dari parameter GET,
     * lalu menghitung total donasi dan pengeluaran selama bulan tersebut,
     * serta menampilkan daftar donasi dan pengeluaran secara paginasi.
     *
     * @return string view('menu/pengurus/data_donatur/view-laporan') view halaman laporan
     */
    public function LaporanDonasi(): string
    {

        $bulan = $this->request->getGet('bulan') ?? date('m');
        $tahun = $this->request->getGet('tahun') ?? date('Y');

        $donasiModel = new DonasiModel();
        $penggunaanModel = new PenggunaanDanaModel();

        // Menghitung total donasi dan pengeluaran
        $total_donasi = $donasiModel->sumDonasiFiltered($bulan, $tahun);
        $total_pengeluaran = $penggunaanModel->sumPengeluaranFiltered($bulan, $tahun);
        $saldo = $total_donasi - $total_pengeluaran;

        // Ambil data donasi dan pengeluaran dengan pagination
        $donasi = $donasiModel->filterDonasiByDate($bulan, $tahun)->paginate(5, 'donasi');
        $pengeluaran = $penggunaanModel->filterPengeluaranByDate($bulan, $tahun)->paginate(5, 'pengeluaran');

        $pager = Services::pager();

        // Kirim semua data ke view
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

        // =======================
        // SHEET 1: DONASI
        // =======================
        $sheetDonasi = $spreadsheet->getActiveSheet();
        $sheetDonasi->setTitle('Donasi');

        $sheetDonasi->setCellValue('A1', 'Laporan Donasi Bulan ' . $bulan . ' Tahun ' . $tahun);
        $sheetDonasi->mergeCells('A1:D1');
        $sheetDonasi->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheetDonasi->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Header donasi
        $sheetDonasi->setCellValue('A3', 'No');
        $sheetDonasi->setCellValue('B3', 'Nama Donatur');
        $sheetDonasi->setCellValue('C3', 'Tanggal Donasi');
        $sheetDonasi->setCellValue('D3', 'Nominal');
        $sheetDonasi->getStyle('A3:D3')->getFont()->setBold(true);

        $row = 4;
        $no = 1;
        foreach ($donasi as $d) {
            $sheetDonasi->setCellValue('A' . $row, $no++);
            $sheetDonasi->setCellValue('B' . $row, $d['nama_donatur']);
            $sheetDonasi->setCellValue('C' . $row, $d['tanggal_donasi']);
            $sheetDonasi->setCellValue('D' . $row, (int) $d['nominal']);
            $row++;
        }

        $sheetDonasi->getStyle('D4:D' . ($row - 1))->getNumberFormat()->setFormatCode('#,##0');
        foreach (range('A', 'D') as $col) {
            $sheetDonasi->getColumnDimension($col)->setAutoSize(true);
        }
        $sheetDonasi->getStyle('A3:D' . ($row - 1))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // =======================
        // SHEET 2: PENGELUARAN
        // =======================
        $sheetPengeluaran = $spreadsheet->createSheet();
        $sheetPengeluaran->setTitle('Pengeluaran');

        $sheetPengeluaran->setCellValue('A1', 'Laporan Pengeluaran Bulan ' . $bulan . ' Tahun ' . $tahun);
        $sheetPengeluaran->mergeCells('A1:D1');
        $sheetPengeluaran->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheetPengeluaran->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Header pengeluaran
        $sheetPengeluaran->setCellValue('A3', 'No');
        $sheetPengeluaran->setCellValue('B3', 'Tanggal');
        $sheetPengeluaran->setCellValue('C3', 'Deskripsi');
        $sheetPengeluaran->setCellValue('D3', 'Jumlah');
        $sheetPengeluaran->getStyle('A3:D3')->getFont()->setBold(true);

        $row = 4;
        $no = 1;
        foreach ($pengeluaran as $p) {
            $sheetPengeluaran->setCellValue('A' . $row, $no++);
            $sheetPengeluaran->setCellValue('B' . $row, $p['tanggal']);
            $sheetPengeluaran->setCellValue('C' . $row, $p['deskripsi']);
            $sheetPengeluaran->setCellValue('D' . $row, (int) $p['jumlah']);
            $row++;
        }

        $sheetPengeluaran->getStyle('D4:D' . ($row - 1))->getNumberFormat()->setFormatCode('#,##0');
        foreach (range('A', 'D') as $col) {
            $sheetPengeluaran->getColumnDimension($col)->setAutoSize(true);
        }
        $sheetPengeluaran->getStyle('A3:D' . ($row - 1))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // =======================
        // OUTPUT EXCEL
        // =======================
        $filename = 'Laporan_Keuangan_' . $bulan . '_' . $tahun . '.xlsx';

        ob_end_clean(); // menghindari error header
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }

}
