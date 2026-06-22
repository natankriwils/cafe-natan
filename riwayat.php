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
</head>
<body>

<h1>Riwayat Pembelian</h1>

<a href="dashboard.php">Dashboard</a>
<br><br>

<hr>

<table border="1" cellpadding="10">

    <tr>
        <th>ID</th>
        <th>Tanggal</th>
        <th>Total Harga</th>
        <th>Aksi</th>
    </tr>

    <?php while($row = mysqli_fetch_assoc($result)): ?>

    <tr>
        <td><?= $row["id"] ?></td>
        <td><?= $row["created_at"] ?></td>
        <td>Rp <?= number_format($row["total_harga"], 0, ',', '.') ?></td>
        <td>
            <a href="receipt.php?id=<?= $row['id'] ?>">
                Lihat Receipt
            </a>
        </td>
    </tr>

    <?php endwhile; ?>

</table>

</body>
</html>