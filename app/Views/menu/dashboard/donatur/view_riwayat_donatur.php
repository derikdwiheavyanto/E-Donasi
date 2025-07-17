<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluit">
    <h1 class="mt-4">Riwayat Donasi</h1>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Jumlah Donasi</th>
                <th scope="col">Pembayaran</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($donasi)) : ?>
                <?php $no = 1; ?>
                <?php foreach ($donasi as $row) : ?>
                    <tr>
                        <th scope="row"><?= $no++; ?></th>
                        <td><?= date('d/m/Y', strtotime($row['tanggal_donasi'])); ?></td>
                        <td>Rp.<?= number_format($row['nominal'], 0, ',', '.'); ?></td>
                        <td><?= $row['pembayaran']; ?></td>
                        <td>Sukses</td> <!-- Jika belum ada kolom status, bisa ditulis manual -->
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5" class="text-center">Belum ada donasi.</td>
                </tr>
            <?php endif; ?>
        </tbody>
        
    </table>
</div>

<?= $this->endSection(); ?>