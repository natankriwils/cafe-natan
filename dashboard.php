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

    <nav class="navbar">

        <div class="container navbar-container">
            <a class="navbar-brand">Cafe Natan</a>
            <a href="logout.php" class="nav-link active">Logout</a>
        </div>

    </nav>

    <section class="hero">
        <h1>Dashboard</h1>
        <p class="tagline">Coffee & Cashier Management</p>
        <p>Selamat datang, <?= $_SESSION["admin"] ?></p>
    </section>

    <div class="dashboard-grid">
        <div class="dashboard-card">
            <h3>Kasir</h3>
            <p>Mulai transaksi dan pilih menu pelanggan.</p>
            <a href="kasir.php" class="btn-card">Buka Kasir</a>
        </div>

        <div class="dashboard-card">
            <h3>Kelola Menu</h3>
            <p>Tambah, edit, atau hapus daftar menu.</p>
            <a href="menu.php" class="btn-card">Kelola Menu</a>
        </div>

        <div class="dashboard-card">
            <h3>Riwayat Pembelian</h3>
            <p>Lihat seluruh transaksi pelanggan.</p>
            <a href="riwayat.php" class="btn-card">Lihat Riwayat</a>
        </div>

    </div>

</body>

</html>
