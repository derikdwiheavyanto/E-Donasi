<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>

    <!-- Ganti semua CDN ke file lokal -->
    <!-- <link href="assets/css/simple-datatables.min.css" rel="stylesheet" /> -->
    <link href="assets/css/styles.css" rel="stylesheet" />
    <!-- <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js"></script> -->
</head>

<body class="sb-nav-fixed">
    <!-- topbar -->
    <?php echo view('layout/template/view_topbar'); ?>
    <!-- end topbar -->

    <div id="layoutSidenav">
        <!-- sidebar -->
        <?php echo view('layout/template/view_sidebar'); ?>
        <!-- end sidebar -->

        <div id="layoutSidenav_content">
            <!-- content -->
            <main>
                <div class="container-fluid px-4">
                    <!-- Render Content -->
                    <?php echo $this->renderSection('content'); ?>
                </div>
            </main>
            <!-- end content -->

            <!-- footer -->
            <?php echo view('layout/template/view_footer'); ?>
            <!-- end footer -->
        </div>
    </div>

    <!-- JS lokal -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="assets/js/scripts.js"></script> -->
    <script src="assets/js/Chart.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script> -->
    <script src="assets/js/simple-datatables.min.js"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
    <?php echo $this->renderSection('script'); ?>
</body>

</html>