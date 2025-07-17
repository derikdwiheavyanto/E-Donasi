<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluit">
    <h1 class="mt-4">Laporan Donasi</h1>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>12/12/2012</td>
                <td>Pembangunan masjid</td>
                <td>Rp.500.000</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>12/12/2012</td>
                <td>Pembangunan masjid</td>
                <td>Rp.500.000</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>12/12/2012</td>
                <td>Pembangunan masjid</td>
                <td>Rp.500.000</td>
            </tr>
        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>