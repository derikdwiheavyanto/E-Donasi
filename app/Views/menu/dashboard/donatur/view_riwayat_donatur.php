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
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>12/12/2012</td>
                <td>Rp.12.000.000</td>
                <td>Sukses</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>12/12/2012</td>
                <td>Rp.12.000.000</td>
                <td>Sukses</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>12/12/2012</td>
                <td>Rp.12.000.000</td>
                <td>Sukses</td>
            </tr>
        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>