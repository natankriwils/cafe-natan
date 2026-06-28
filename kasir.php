<?php

session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

require 'config.php';

$query = "SELECT * FROM menu";

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <nav class="navbar navbar-expand">
        <div class="container">
            <a class="navbar-brand">
                Cafe Natan
            </a>
            <div class="ms-auto">
                <a href="dashboard.php" class="nav-link active">
                    Dashboard
                </a>
            </div>
        </div>
    </nav>
    <div class="hero">
        <h1>Kasir</h1>
        <p class="tagline">
            Pilih menu untuk customer
        </p>
    </div>
    <div class="container">
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="col-md-4 mb-4">
                    <div class="menu-card">
                        <h4>
                            <?= $row["nama_menu"] ?>
                        </h4>
                        <p>
                            Rp <?= number_format($row["harga"], 0, ',', '.') ?>
                        </p>
                        <a href="tambah_keranjang.php?id=<?= $row['id'] ?>" class="btn-card">
                            Tambah
                        </a>
                        <a href="kurang_keranjang.php?id=<?= $row['id'] ?>" class="btn-card">
                            Kurang
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <hr>

        <div class="row mt-5 justify-content-center">
            <div class="col-md-5 mx-auto">
                <div class="cart-card">
                    <h2>Keranjang</h2>
                    <br>
                    <?php
                    $total = 0;
                    foreach ($_SESSION["keranjang"] as $id_menu => $jumlah):
                        $query = "SELECT * FROM menu WHERE id = $id_menu";
                        $result_menu = mysqli_query($conn, $query);
                        $menu = mysqli_fetch_assoc($result_menu);
                        $subtotal = $menu["harga"] * $jumlah;
                        $total += $subtotal;
                    ?>
                        <div class="cart-item">
                            <strong>
                                <?= $menu["nama_menu"] ?>
                            </strong>
                            <span class="float-end">
                                x<?= $jumlah ?>
                            </span>
                            <br>
                            Rp <?= number_format($subtotal, 0, ',', '.') ?>
                        </div>

                    <?php endforeach; ?>
                    <hr>
                    <h4>Total</h4>

                    <h3>
                        Rp <?= number_format($total, 0, ',', '.') ?>
                    </h3>

                    <br>

                    <form action="simpan_transaksi.php" method="POST">

                        <button
                            type="submit"
                            class="btn-save">
                            Simpan Transaksi
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>

</body>

</html>
