<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <nav class="navbar navbar-expand navbar-light bg-white">
        <div class="container-fluid">

            <a class="navbar-brand" href="#">
                Cafe Dashboard
            </a>

            <section class="hero">
                <h1>Welcome Back, <?= $_SESSION["admin"] ?>!</h1>
                <p class="tagline">
                    Manage cafe operations.
                </p>
            </section>

            <div class="container">
                <div class="row g-4">
                    <div class="col-md-4">
                        <a href="menu.php" class="dashboard-card">
                            <h3>Kelola Menu</h3>
                            <p>
                                Tambah, edit, dan hapus menu cafe.
                            </p>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="kasir.php" class="dashboard-card">
                            <h3>Kasir</h3>
                            <p>
                                Untuk transaksi customer.
                            </p>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="riwayat.php" class="dashboard-card">
                            <h3>Riwayat Transaksi</h3>
                            <p>
                                Lihat seluruh riwayat transaksi.
                            </p>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="logout.php" class="dashboard-card">
                            <h3>logout</h3>
                            <p>
                                Keluar akun.
                            </p>
                        </a>
                    </div>
                </div>
            </div>

</body>

</html>
