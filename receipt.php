<?php

session_start();

require 'config.php';

$id = $_GET["id"];

$query = "SELECT * FROM transaksi
          WHERE id = $id";

$result = mysqli_query($conn, $query);

$transaksi = mysqli_fetch_assoc($result);

$query = "
SELECT
    detail_transaksi.*,
    menu.nama_menu

FROM detail_transaksi

JOIN menu
ON detail_transaksi.menu_id = menu.id

WHERE transaksi_id = $id
";

$result_detail = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar">

    <div class="container navbar-container">
        <a class="navbar-brand">Cafe Natan</a>
        <a href="dashboard.php" class="nav-link active">Dashboard</a>
    </div>

</nav>

<div class="container">

    <div class="receipt-card">
        <h1>Receipt</h1>
        <p class="tagline">Detail Transaksi Pelanggan</p>
        <hr>

        <h2>Cafe Natan</h2>
        <p class="receipt-subtitle">Coffee & Cashier Management</p>
        <hr>

        <h4>Receipt #<?= $transaksi["id"] ?></h4>
        <p class="receipt-date-title">Tanggal</p>
        <p class="receipt-date"><?= date("Y-m-d H:i", strtotime($transaksi["created_at"])) ?></p>
        <hr>

        <?php while ($item = mysqli_fetch_assoc($result_detail)): ?>

            <div class="receipt-item">

                <div class="receipt-row">
                    <strong><?= $item["nama_menu"] ?></strong>
                    <span>x<?= $item["jumlah"] ?></span>
                </div>

                <p>Rp <?= number_format($item["subtotal"], 0, ',', '.') ?></p>

            </div>

        <?php endwhile; ?>

        <hr>

        <div class="receipt-total">
            <h4>Total</h4>
            <strong>Rp <?= number_format($transaksi["total_harga"], 0, ',', '.') ?></strong>
        </div>

        <hr>
        <p class="receipt-thanks">Terima Kasih</p>

    </div>

    <div class="receipt-button">
        <a href="kasir.php" class="btn-card">Kembali ke Kasir</a>
    </div>

</div>

</body>
</html>
