<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<?= $this->include('menu/dashboard/donatur/view_dashboard_donatur'); ?>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    const ctx = document.getElementById('donasiChart').getContext('2d');
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