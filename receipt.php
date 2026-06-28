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

        <a class="navbar-brand">
            Cafe Natan
        </a>

        <a href="dashboard.php" class="nav-link active">
            Dashboard
        </a>

    </div>

</nav>

<div class="container">

    <div class="receipt-card">

        <h1>Receipt</h1>

        <p class="tagline">
            Detail Transaksi Pelanggan
        </p>

        <hr>

        <h2>Cafe Natan</h2>

        <p class="receipt-subtitle">
            Coffee & Cashier Management
        </p>

        <hr>

        <h4>
            Receipt #<?= $transaksi["id"] ?>
        </h4>

        <p>
            <?= $transaksi["created_at"] ?>
        </p>

        <hr>

        <?php while($item = mysqli_fetch_assoc($result_detail)): ?>

            <div class="receipt-item">

                <strong>
                    <?= $item["nama_menu"] ?>
                </strong>

                <span class="qty">
                    x<?= $item["jumlah"] ?>
                </span>

                <br>

                Rp <?= number_format(
                    $item["subtotal"],
                    0,
                    ',',
                    '.'
                ) ?>

            </div>

        <?php endwhile; ?>

        <hr>

        <h4>Total</h4>

        <h3>
            Rp <?= number_format(
                $transaksi["total_harga"],
                0,
                ',',
                '.'
            ) ?>
        </h3>

        <hr>

        <p>
            Terima Kasih
        </p>

    </div>

    <div class="receipt-button">

        <a href="kasir.php" class="btn-card">
            Kembali ke Kasir
        </a>

    </div>

</div>

</body>
</html>
