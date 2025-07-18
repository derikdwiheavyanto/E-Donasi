<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <h1 class="mt-4">Transparansi Donasi</h1>

    <!-- Ringkasan Donasi -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    Total Donasi Masuk
                    <div class="h4 mt-2">Rp. 12.500.000</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white shadow">
                <div class="card-body">
                    Total Dana Terpakai
                    <div class="h4 mt-2">Rp. 7.300.000</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white shadow">
                <div class="card-body">
                    Sisa Dana
                    <div class="h4 mt-2">Rp. 5.200.000</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    Jumlah Donatur
                    <div class="h4 mt-2">35 Orang</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Progress -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header">
            <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
                <h5 class="mb-2 mb-md-0">Filter Penggunaan Dana</h5>
                <form class="d-flex flex-column flex-md-row align-items-start align-items-md-center gap-2" method="get">
                    <div class="form-group mb-0">
                        <label for="start" class="form-label mb-1">Tanggal Mulai</label>
                        <input type="date" class="form-control form-control-sm" name="start" id="start">
                    </div>
                    <div class="form-group mb-0">
                        <label for="end" class="form-label mb-1">Tanggal Akhir</label>
                        <input type="date" class="form-control form-control-sm" name="end" id="end">
                    </div>
                    <div class="d-flex align-items-end">
                        <button type="submit" class="btn btn-sm btn-primary mt-md-4">Terapkan</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            <h6 class="mb-3">Progress Penggunaan Dana</h6>
            <div class="progress" style="height: 25px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: 58%;" aria-valuenow="58"
                    aria-valuemin="0" aria-valuemax="100">
                    58% Dana Digunakan
                </div>
            </div>
        </div>
    </div>



    <!-- Grafik Donasi -->
    <div class="card mb-4">
        <div class="card-header">Grafik Donasi Masuk per Bulan</div>
        <div class="card-body">
            <canvas id="chartDonasi" width="100%" height="30"></canvas>
        </div>
    </div>

    <!-- Rincian Penggunaan Dana -->
    <div class="card mb-4">
        <div class="card-header">Rincian Penggunaan Dana</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Jumlah</th>
                        <th>Bukti</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>2025-07-01</td>
                        <td>Pembelian sembako</td>
                        <td>Rp. 1.500.000</td>
                        <td><a href="#">Lihat</a></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>2025-06-25</td>
                        <td>Renovasi atap</td>
                         <td>Rp. 5.800.000</td>
                        <td><a href="#">Lihat</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Notifikasi Update -->
    <div class="alert alert-info">
        <strong>Update!</strong> Laporan keuangan bulan Juni telah diperbarui pada 5 Juli 2025.
    </div>

    <!-- Tabel Donasi Publik (Tanpa Nama Lengkap) -->
    <div class="card mb-4">
        <div class="card-header">Donasi Publik</div>
        <div class="card-body table-responsive">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>Inisial</th>
                        <th>Tanggal</th>
                        <th>Nominal</th>
                        <th>Pesan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>D**K</td>
                        <td>2025-07-14</td>
                        <td>Rp. 150.000</td>
                        <td>Semoga bermanfaat</td>
                    </tr>
                    <tr>
                        <td>R**I</td>
                        <td>2025-07-10</td>
                        <td>Rp. 250.000</td>
                        <td>Untuk anak-anak panti</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    const ctx = document.getElementById('chartDonasi').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'],
            datasets: [
                {
                    label: 'Dana Masuk (Rp)',
                    data: [2000000, 1500000, 1800000, 2200000, 1200000, 2000000, 1000000],
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Penggunaan Dana (Rp)',
                    data: [1000000, 800000, 900000, 1700000, 1000000, 1500000, 800000],
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    tension: 0.4,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += 'Rp. ' + context.parsed.y.toLocaleString();
                            }
                            return label;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function (value) {
                            return 'Rp. ' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
</script>
<?= $this->endSection(); ?>