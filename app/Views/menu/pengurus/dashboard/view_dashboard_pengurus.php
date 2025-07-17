<!-- DASHBOARD VIEW: dashboard.php -->
<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <h1 class="mt-4"><?= $title; ?></h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Ringkasan Sistem</li>
    </ol>

    <!-- CARD STATISTIK -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Jumlah Donatur</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="text-white"><?= $data['jumlah_donatur']; ?></span>
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Total Donasi</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="text-white"> <?= format_rupiah($data['total_donasi']) ?></span>
                    <i class="fas fa-donate"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white mb-4">
                <div class="card-body">Total Pengeluaran</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="text-white"><?= format_rupiah($data['total_pengeluaran']) ?></span>
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">Dana Saat ini</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="text-white"><?= format_rupiah($data['dana_saat_ini']) ?></span>
                    <i class="fas fa-user-plus"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- DONASI TERBARU TABLE -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-hand-holding-heart me-1"></i> Donasi Terbaru
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Nama Donatur</th>
                        <th>Tanggal</th>
                        <th>Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['data_donasi_terbaru'] as $key => $donasi): ?>
                        <tr>
                            <td><?= $donasi['nama_donatur']; ?></td>
                            <td><?= $donasi['tanggal_donasi']; ?></td>
                            <td><?= format_rupiah($donasi['nominal']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- GRAFIK DONASI BULANAN -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-chart-line me-1"></i> Tren Donasi (6 Bulan Terakhir)
        </div>
        <div class="card-body">
            <canvas id="donasiChart" width="100%" height="40"></canvas>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    const ctxDonatur = document.getElementById('donasiChart');
    new Chart(ctxDonatur, {
        type: 'line',

        data: {
            labels: <?= $data['data_trend_donasi']['chart_labels'] ?>,
            datasets: [{
                label: 'Total Donasi',
                data: <?= $data['data_trend_donasi']['chart_values'] ?>,
                borderColor: 'rgba(54, 185, 204, 1)',
                backgroundColor: 'rgba(54, 185, 204, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        var value = tooltipItem.yLabel;
                        value = parseInt(value);
                        var formatted = 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');

                        var label = data.datasets[tooltipItem.datasetIndex].label || '';
                        return label + ': ' + formatted;
                    }
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function (value) {
                            return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                        }
                    }
                }]
            }

        }
    });
</script>

<?= $this->endSection();
