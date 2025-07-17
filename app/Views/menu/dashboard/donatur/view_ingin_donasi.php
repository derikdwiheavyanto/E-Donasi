<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid" style="margin-top: 20px;">
    <h3>Form Donasi</h3>
    <form action="/donasi/simpan" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Donatur</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal Donasi</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah Donasi</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Contoh: 100000" required>
        </div>
        <div class="mb-3">
            <label for="pembayaran" class="form-label">Metode Pembayaran</label>
            <select class="form-select" id="pembayaran" name="pembayaran" required>
                <option value="">-- Pilih Metode --</option>
                <option value="Transfer Bank">Transfer Bank</option>
                <option value="E-Wallet">E-Wallet</option>
                <option value="Tunai">Tunai</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="bukti" class="form-label">Upload Bukti Pembayaran</label>
            <input class="form-control" type="file" id="bukti" name="bukti" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan Donasi</button>
    </form>
</div>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<link href="/assets/css/styles.css" rel="stylesheet">

<?= $this->endSection(); ?>