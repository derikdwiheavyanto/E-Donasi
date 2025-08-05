<?= $this->extend('layout/layout'); ?>

<?= $this->section('content'); ?>

<h1 class="mt-4"><?= $title; ?></h1>
<ol class="breadcrumb mb-4 d-flex justify-content-between">
  <li class="breadcrumb-item active">Dashboard</li>

</ol>
<?php if (session()->getFlashdata('success')): ?>
  <div class="alert alert-success">
    <?= session()->getFlashdata('success'); ?>
  </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
  <div class="alert alert-danger">
    <?= session()->getFlashdata('error'); ?>
  </div>
<?php endif; ?>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Tanggal</th>
      <th scope="col">Nama Donatur</th>
      <th scope="col">Jumlah Donasi</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($donasi as $index => $row): ?>
      <tr>
        <th><?= $index + 1; ?></th>
        <td><?= date('d/m/Y', strtotime($row['tanggal_donasi'])); ?></td>
        <td><?= esc($row['nama_donatur']) ?></td>
        <td>Rp. <?= number_format($row['nominal'], 0, ',', '.'); ?></td>
        <td>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="cursor: pointer;" class="bi bi-trash3-fill" viewBox="0 0 16 16"
          data-bs-toggle="modal" data-bs-target="#deleteModal<?= $index ?>">
            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" 
            />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="cursor: pointer;" class="bi bi-eye-fill" viewBox="0 0 16 16"
          data-bs-toggle="modal" data-bs-target="#detailModal<?= $index ?>">
            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
          </svg>
        </td>
      </tr>
      <!-- Modal Detail -->
      <div class="modal fade" id="detailModal<?= $index ?>" tabindex="-1" aria-labelledby="detailLabel<?= $index ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="detailLabel<?= $index ?>">Detail Donasi</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
              <p><strong>Tanggal:</strong> <?= date('d/m/Y', strtotime($row['tanggal_donasi'])) ?></p>
              <p><strong>Nama Donatur:</strong> <?= esc($row['nama_donatur']) ?></p>
              <p><strong>Jumlah Donasi:</strong> Rp. <?= number_format($row['nominal'], 0, ',', '.') ?></p>
              <?php if (!empty($row['keterangan'])): ?>
                <p><strong>Pesan:</strong> <?= esc($row['keterangan']) ?></p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Hapus -->
      <div class="modal fade" id="deleteModal<?= $index ?>" tabindex="-1" aria-labelledby="deleteLabel<?= $index ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-danger text-white">
              <h5 class="modal-title" id="deleteLabel<?= $index ?>">Konfirmasi Hapus</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
              Apakah Anda yakin ingin menghapus donasi dari <strong><?= esc($row['nama_donatur']) ?></strong> pada tanggal <strong><?= date('d/m/Y', strtotime($row['tanggal_donasi'])) ?></strong>?
            </div>
            <div class="modal-footer">
              <form method="post" action="<?= base_url('pengurus/riwayat-donasi/delete/' . $row['id_donasi']) ?>">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-danger">Hapus</button>
              </form>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </tbody>
</table>
<?= $this->endSection(); ?>