<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Klinik Kecantikan</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <!-- Google maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=initMap"></script>
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top shadow" id="mainNav" style="background-color: var(--magenta)">
        <div class="container px-4 py-2">
            <a class="navbar-brand poppins-semibold" href="index.php">SIG Klinik Kecantikan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse poppins-regular" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#services">Klinik</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">Peta</a></li>
                    <li class="nav-item"><a class="nav-link" href="#compare">Perbandingan</a></li>
                    <?php
                    if (!isset($_SESSION["login_user"])) {
                    ?>
                        <li class="nav-item"><a class="nav-link" href="#contact">Masuk</a></li>
                    <?php
                    } else {
                    ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Hai, <?= $_SESSION["nama"] ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="logout.php">Keluar</a></li>
                            </ul>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="min-vh-100 d-flex justify-content-center align-items-center" style="background-image: url(assets/jumbotron2.png); background-position: center">
        <div class="container px-4 text-center">
            <h1 class="fs-2 poppins-semibold text-shadow">Selamat Datang di Sistem Informasi Geografis Klinik Kecantikan</h1>
            <p class="lead poppins-regular text-shadow">Temukan berbagai klinik kecantikan di wilayah Kota Pontianak</p>
            <a class="btn btn-lg poppins-regular text-white btn-on-hover" href="#services" style="background-color: var(--magenta)">Mulai Mencari!</a>
        </div>
    </header>