<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <h1 class="mt-4">Dashboard Donatur</h1>
    <p class="mb-4 text-muted">Terima kasih atas partisipasi Anda dalam program donasi kami.</p>

    <!-- STATISTIC CARDS -->
    <div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">Total Donasi Anda</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <span class="text-white">Rp 3.000.000</span>
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">Jumlah Donasi</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <span class="text-white">10 Kali</span>
                <i class="fas fa-donate"></i>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-info text-white mb-4">
            <div class="card-body">Donasi Terakhir</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <span class="text-white">Rp 285.000</span>
                <i class="fas fa-chart-line"></i>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body">Tanggal Donasi Terakhir</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <span class="text-white">15/7/2000</span>
                <i class="fas fa-user-plus"></i>
            </div>
        </div>
    </div>
</div>

    <!-- DONASI HISTORY TABLE -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-history me-1"></i> Riwayat Donasi Anda
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Program</th>
                        <th>Nominal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>10 Juli 2025</td>
                        <td>Bantuan Pendidikan</td>
                        <td>Rp 500.000</td>
                        <td><span class="badge bg-success">Terverifikasi</span></td>
                    </tr>
                    <tr>
                        <td>01 Juli 2025</td>
                        <td>Santunan Yatim</td>
                        <td>Rp 300.000</td>
                        <td><span class="badge bg-success">Terverifikasi</span></td>
                    </tr>
                    <tr>
                        <td>15 Juni 2025</td>
                        <td>Donasi Masjid</td>
                        <td>Rp 400.000</td>
                        <td><span class="badge bg-success">Terverifikasi</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- DONATION TREND CHART -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-chart-line me-1"></i> Grafik Donasi Anda (6 Bulan Terakhir)
        </div>
        <div class="card-body">
            <canvas id="donasiDonaturChart" width="100%" height="30"></canvas>
        </div>
    </div>
</div>

<script>
    const ctxDonatur = document.getElementById('donasiDonaturChart');
    new Chart(ctxDonatur, {
        type: 'line',
        data: {
            labels: ['Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'],
            datasets: [{
                label: 'Total Donasi',
                data: [250000, 500000, 300000, 700000, 450000, 600000],
                borderColor: 'rgba(54, 185, 204, 1)',
                backgroundColor: 'rgba(54, 185, 204, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
</script>

<?= $this->endSection(); ?>
