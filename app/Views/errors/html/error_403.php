<?php helper('url'); ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>403 - Akses Ditolak</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            text-align: center;
            padding-top: 100px;
        }

        h1 {
            font-size: 80px;
            color: #dc3545;
        }

        p {
            font-size: 20px;
            color: #6c757d;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>

<body>
    <h1>403</h1>
    <p>Anda tidak memiliki izin untuk mengakses halaman ini.</p>
    <p><a href="<?= base_url('/') ?>">Kembali ke Beranda</a></p>
</body>

</html>