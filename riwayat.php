<?php

session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

require 'config.php';

$query = "SELECT * FROM transaksi
          ORDER BY id ASC";

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Pembelian</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar">

    <div class="container navbar-container">

        <a class="navbar-brand">Cafe Natan</a>

        <a href="dashboard.php" class="nav-link active">Dashboard</a>

    </div>

</nav>

<section class="hero">

    <h1>Riwayat Pembelian</h1>

    <p class="tagline">Daftar transaksi pelanggan</p>

</section>

<div class="container">

    <div class="history-list">

        <?php while ($row = mysqli_fetch_assoc($result)): ?>

            <div class="history-card">

                <h3>Receipt #<?= $row["id"] ?></h3>

                <p class="history-label">Tanggal</p>

                <p class="history-date">
                    <?= date("Y-m-d H:i", strtotime($row["created_at"])) ?>
                </p>

                <hr>

                <p class="history-label">Total</p>

                <strong class="history-total">
                    Rp <?= number_format($row["total_harga"], 0, ',', '.') ?>
                </strong>

                <a href="receipt_riwayat.php?id=<?= $row["id"] ?>" class="btn-save">
                    Lihat Receipt
                </a>

            </div>

        <?php endwhile; ?>

    </div>

</div>

</body>

</html>
