<!-- DASHBOARD VIEW: dashboard.php -->
<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Ringkasan Sistem</li>
    </ol>

    <!-- CARD STATISTIK -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Jumlah Donatur</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="text-white">120 orang</span>
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Total Donasi Bulan Ini</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="text-white">Rp 10.250.000</span>
                    <i class="fas fa-donate"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white mb-4">
                <div class="card-body">Donasi Rata-Rata</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="text-white">Rp 285.000</span>
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">Dana Saat ini</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="text-white">Rp. 5.000.000</span>
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
                    <tr>
                        <td>Budi Santoso</td>
                        <td>14 Juli 2025</td>
                        <td>Rp 500.000</td>
                    </tr>
                    <tr>
                        <td>Siti Aisyah</td>
                        <td>13 Juli 2025</td>
                        <td>Rp 250.000</td>
                    </tr>
                    <tr>
                        <td>Andi Pratama</td>
                        <td>13 Juli 2025</td>
                        <td>Rp 300.000</td>
                    </tr>
                    <tr>
                        <td>Maria Ulfa</td>
                        <td>12 Juli 2025</td>
                        <td>Rp 150.000</td>
                    </tr>
                    <tr>
                        <td>Dedi Kurniawan</td>
                        <td>12 Juli 2025</td>
                        <td>Rp 600.000</td>
                    </tr>
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
            <canvas id="donasiChart" width="100%" height="30"></canvas>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>