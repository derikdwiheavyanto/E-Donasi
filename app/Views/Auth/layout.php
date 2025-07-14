<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Register</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/login.css">
    <style>
        .right-image {
            position: fixed;
            right: 0;
            top: 0;
            width: 50%;
            height: 100vh;
            object-fit: cover;
            z-index: -1;
        }

        .form-container {
            width: 100%;
            max-width: 600px;
            padding: 60px 40px;
            min-height: 100vh;
        }

        @media (max-width: 768px) {
            .right-image {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Form Content -->
            <div class="col-md-6 d-flex align-items-start justify-content-center">
                <div class="form-container">
                    <div class="mb-4">
                        <h1 class="text-primary">E-Donasi Panti Asuhan</h1>
                    </div>
                    <?= $this->renderSection('content') ?>
                </div>
            </div>

            <!-- Gambar di kanan -->
            <div class="col-md-6 d-none d-md-block">
                <img src="https://fip.unj.ac.id/pls/wp-content/uploads/2023/06/Play-for-hope1.jpg" class="right-image" alt="login image">
            </div>
        </div>
    </div>
</body>

</html>