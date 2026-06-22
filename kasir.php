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
</head>
<body>

<h1>Halaman Kasir</h1>

<a href="dashboard.php">Dashboard</a>

<br><br>

<table border="1" cellpadding="10">

    <tr>
        <th>Nama Menu</th>
        <th>Harga</th>
        <th>Aksi</th>
    </tr>

    <?php while($row = mysqli_fetch_assoc($result)): ?>

    <tr>
        <td><?= $row["nama_menu"] ?></td>

        <td>
            Rp <?= number_format($row["harga"], 0, ',', '.') ?>
        </td>

        <td>

            <a href="tambah_keranjang.php?id=<?= $row['id'] ?>">
                Tambah
            </a>

            |

            <a href="kurang_keranjang.php?id=<?= $row['id'] ?>">
                Kurang
            </a>

        </td>
    </tr>

    <?php endwhile; ?>

</table>

<hr>

<h2>Keranjang</h2>

<?php

$total = 0;

if (isset($_SESSION["keranjang"])) {

    foreach ($_SESSION["keranjang"] as $id => $jumlah) {

        $query = "SELECT * FROM menu WHERE id = $id";

        $result_menu = mysqli_query($conn, $query);

        $menu = mysqli_fetch_assoc($result_menu);

        $subtotal = $menu["harga"] * $jumlah;

        $total += $subtotal;

?>

<p>
    <?= $menu["nama_menu"] ?>
    x<?= $jumlah ?>
    =
    Rp <?= number_format($subtotal, 0, ',', '.') ?>
</p>

<?php
    }
}
?>

<hr>

<h3>
    Total:
    Rp <?= number_format($total, 0, ',', '.') ?>
</h3>

<form action="simpan_transaksi.php" method="POST">

    <button type="submit">
        Simpan Transaksi
    </button>

</form>

</body>
</html>