<?= $this->extend('layout/layout'); ?>

<?= $this->section('content'); ?>

<h1 class="mt-4"><?= $title; ?></h1>

<div class="container">
    <table id="datatablesSimple">
        <thead>
            <tr>
                <th>Tanggal Donasi</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Umur</th>
                <th>Jumlah Donasi</th>
            </tr>
        </thead>
        <?php foreach ($user as $key => $donatur): ?>
            <tr>
                <td><?= $donatur->created_at; ?></td>
                <td><?= $donatur->username; ?></td>
                <td>Prapatan rungkut</td>
                <td>61</td>
                <td>1.000.000</td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
</div>
</div>

<?= $this->endSection(); ?>