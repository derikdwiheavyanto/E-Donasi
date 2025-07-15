<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Dashboard E-Donasi" />
    <meta name="author" content="Tim E-Donasi" />
    <title>Dashboard - E-Donasi</title>

    <!-- Ganti semua CDN ke file lokal -->
    <!-- <link href="assets/css/simple-datatables.min.css" rel="stylesheet" /> -->
    <link href="<?= base_url('assets/css/styles.css') ?>" rel="stylesheet" />
    <!-- <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js"></script> -->
</head>

<body class="sb-nav-fixed">

    <!-- topbar -->
    <?= view('layout/template/view_topbar'); ?>
    <!-- end topbar -->

    <div id="layoutSidenav">
        
        <!-- sidebar -->
        <?php if (in_groups('pengurus')): ?>
            <?= view('layout/template/view_sidebar_pengurus'); ?>
        <?php elseif (in_groups('donatur')): ?>
            <?= view('layout/template/view_sidebar_donatur'); ?>
        <?php else: ?>
            <div class="alert alert-danger m-3">Role pengguna tidak dikenali.</div>
        <?php endif; ?>
        <!-- end sidebar -->

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <!-- Render isi halaman -->
                    <?= $this->renderSection('content'); ?>
                </div>
            </main>

            <!-- footer -->
            <?= view('layout/template/view_footer'); ?>
            <!-- end footer -->
        </div>
    </div>

    <!-- JS lokal -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/scripts.js') ?>"></script>
    <script src="<?= base_url('assets/js/Chart.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/simple-datatables.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/datatables-simple-demo.js') ?>"></script>
    <?php echo $this->renderSection('script'); ?>
</body>

</html>
