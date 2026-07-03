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

    <nav class="navbar">

        <div class="container navbar-container">
            <a class="navbar-brand">Cafe Natan</a>
            <a href="dashboard.php" class="nav-link active">Dashboard</a>
        </div>

    </nav>

    <section class="hero">
        <h1>Kasir</h1>
        <p class="tagline">Pilih menu untuk customer</p>
    </section>

    <div class="container">

        <div class="row">

            <?php while ($row = mysqli_fetch_assoc($result)): ?>

                <?php $jumlah = $_SESSION["keranjang"][$row["id"]] ?? 0; ?>

                <div class="col-md-4 mb-4">

                    <div class="menu-card">
                        <h4><?= $row["nama_menu"] ?></h4>
                        <p>Rp <?= number_format($row["harga"], 0, ',', '.') ?></p>

                        <div class="qty-control">
                            <a href="kurang_keranjang.php?id=<?= $row["id"] ?>" class="qty-btn">−</a>
                            <span class="qty-number"><?= $jumlah ?></span>
                            <a href="tambah_keranjang.php?id=<?= $row["id"] ?>" class="qty-btn">+</a>   
                        </div>

                    </div>

                </div>

            <?php endwhile; ?>

        </div>

        <hr class="section-divider">

        <div class="row justify-content-center">

            <div class="col-lg-5">

                <div class="cart-card">

                    <div class="cart-header">
                        <h2>Keranjang</h2>
                    </div>

                    <div class="cart-body">

                        <?php

                        $total = 0;

                        if (!empty($_SESSION["keranjang"])):

                            foreach ($_SESSION["keranjang"] as $id_menu => $jumlah):

                                $query = "SELECT * FROM menu WHERE id = $id_menu";

                                $result_menu = mysqli_query($conn, $query);

                                $menu = mysqli_fetch_assoc($result_menu);

                                $subtotal = $menu["harga"] * $jumlah;

                                $total += $subtotal;

                        ?>
                        
                        <div class="cart-item">
                            <span><?= $menu["nama_menu"] ?></span>
                            <span>x<?= $jumlah ?></span>
                        </div>

                        <?php endforeach; ?>

                        <?php else: ?>

                            <p class="cart-empty">Keranjang masih kosong.</p>

                        <?php endif; ?>

                    </div>

                    <div class="cart-total">
                        <p>Total</p>
                        <strong>Rp <?= number_format($total, 0, ',', '.') ?></strong>
                    </div>

                    <form action="simpan_transaksi.php" method="POST">
                        <button type="submit" class="btn-save">Simpan Transaksi</button>
                    </form>

                </div>

            </div>

        </div>

    </div>
</body>
</html>
