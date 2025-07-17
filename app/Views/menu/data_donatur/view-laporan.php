<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
  <h1 class="mt-4"><?= $title; ?></h1>

  <form method="get" class="mb-4">
    <div class="row g-2">
      <div class="col-md-3">
        <select name="bulan" class="form-control">
          <?php for ($i = 1; $i <= 12; $i++): ?>
            <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT); ?>" <?= ($bulan == str_pad($i, 2, '0', STR_PAD_LEFT)) ? 'selected' : '' ?>>
              <?= date('F', mktime(0, 0, 0, $i, 10)); ?>
            </option>
          <?php endfor; ?>
        </select>
      </div>
      <div class="col-md-3">
        <select name="tahun" class="form-control">
          <?php for ($i = date('Y'); $i >= 2022; $i--): ?>
            <option value="<?= $i ?>" <?= ($tahun == $i) ? 'selected' : '' ?>><?= $i ?></option>
          <?php endfor; ?>
        </select>
      </div>
      <div class="col-md-2">
        <button class="btn btn-primary w-100">Tampilkan</button>
      </div>
      <div class="col-md-2">
        <a href="<?= base_url('pengurus/laporandonasi/exportExcel?bulan=' . $bulan . '&tahun=' . $tahun) ?>"
          class="btn btn-success w-100">
          <i class="fas fa-file-excel"></i> Export Excel
        </a>
      </div>
    </div>

  </form>

  <!-- RINGKASAN -->
  <div class="row mb-4 g-2">
    <div class="col-md-4">
      <div class="card bg-success text-white">
        <div class="card-body">Total Donasi Masuk</div>
        <div class="card-footer"><?= format_rupiah($total_donasi); ?></div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card bg-danger text-white">
        <div class="card-body">Total Pengeluaran Dana</div>
        <div class="card-footer"><?= format_rupiah($total_pengeluaran); ?></div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card bg-warning text-white">
        <div class="card-body">Saldo Akhir</div>
        <div class="card-footer"><?= format_rupiah($saldo); ?></div>
      </div>
    </div>
  </div>

  <!-- TABEL DONASI MASUK -->
  <div class="card mb-4">
    <div class="card-header bg-light">Donasi Masuk</div>
    <div class="card-body">
      <table class="table table-bordered table-sm">
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Nama Donatur</th>
            <th>Nominal</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($donasi)): ?>
            <?php foreach ($donasi as $d): ?>
              <tr>
                <td><?= $d['tanggal_donasi']; ?></td>
                <td><?= $d['nama_donatur'] ?? '-'; ?></td>
                <td><?= format_rupiah($d['nominal']); ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="3" class="text-center">Tidak Ada Donasi Masuk</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
      <?= $pager->links('donasi', 'bootstrap') ?>
    </div>
  </div>

  <!-- TABEL PENGGUNAAN DANA -->
  <div class="card">
    <div class="card-header bg-light">Penggunaan Dana</div>
    <div class="card-body">
      <table class="table table-bordered table-sm">
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Deskripsi</th>
            <th>Jumlah</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($pengeluaran)): ?>
            <?php foreach ($pengeluaran as $p): ?>
              <tr>
                <td><?= $p['tanggal']; ?></td>
                <td><?= $p['deskripsi']; ?></td>
                <td><?= format_rupiah($p['jumlah']); ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="3" class="text-center">Tidak Ada Penggunaan Dana</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
      <?= $pager->links('pengeluaran', 'bootstrap') ?>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>