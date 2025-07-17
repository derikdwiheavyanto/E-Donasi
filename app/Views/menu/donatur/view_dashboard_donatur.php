<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <h1 class="mt-4">Dashboard Donatur</h1>
            <p class="mb-4 text-muted">Terima kasih atas partisipasi Anda dalam program donasi kami.</p>
        </div>
        <div class="text-center mb-4 col-md-6 d-flex align-items-center justify-content-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDonasi">
                Donasi Sekarang
            </button>
        </div>
    </div><!-- TOMBOL DONASI -->


    <!-- STATISTIC CARDS -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Total Donasi Anda</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="text-white"><?= format_rupiah($total_donasi) ?? format_rupiah(0) ?></span>
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Jumlah Donasi</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="text-white"><?= $jumlah_transaksi ?> Kali</span>
                    <i class="fas fa-donate"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white mb-4">
                <div class="card-body">Donasi Terakhir</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span
                        class="text-white"><?= format_rupiah($donasi_terakhir['nominal']) ?? format_rupiah(0) ?></span>
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">Tanggal Donasi Terakhir</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="text-white"><?= $donasi_terakhir['tanggal_donasi'] ?? 'Belum ada donasi' ?></span>
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
                        <th>Nominal</th>
                        <th>Pembayaran</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($donasi)): ?>
                        <?php foreach ($donasi as $row): ?>
                            <tr>
                                <td><?= date('d/m/Y', strtotime($row['tanggal_donasi'])); ?></td>
                                <td>Rp.<?= number_format($row['nominal'], 0, ',', '.'); ?></td>
                                <td><?= $row['pembayaran']; ?></td>
                                <td>Sukses</td> <!-- Jika belum ada kolom status, bisa ditulis manual -->
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Belum ada donasi.</td>
                        </tr>
                    <?php endif; ?>
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

<!-- MODAL FORM DONASI -->
<div class="modal fade" id="modalDonasi" tabindex="-1" aria-labelledby="modalDonasiLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/donatur/donasi/payment" method="post" class="modal-content">
            <?= csrf_field() ?>
            <div class="modal-header">
                <h5 class="modal-title" id="modalDonasiLabel">Masukkan Nominal Donasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nominal">Nominal (Rp)</label>
                    <input type="number" name="nominal" id="nominal" class="form-control" placeholder="Contoh: 50000"
                        min="1000" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Lanjutkan</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
    const ctx = document.getElementById('donasiDonaturChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Mar 1", "Mar 2", "Mar 3", "Mar 4", "Mar 5", "Mar 6", "Mar 7", "Mar 8", "Mar 9", "Mar 10", "Mar 11", "Mar 12", "Mar 13"],
            datasets: [{
                label: "Sessions",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: [10000, 30162, 26263, 18394, 18287, 28682, 31274, 33259, 25849, 24159, 32651, 31984, 38451],
            }]
        },
        options: {
            scales: {
                x: {
                    ticks: {
                        maxTicksLimit: 7
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    min: 0,
                    max: 40000,
                    ticks: {
                        maxTicksLimit: 5
                    },
                    grid: {
                        color: "rgba(0, 0, 0, .125)"
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>

<?= $this->endSection(); ?>