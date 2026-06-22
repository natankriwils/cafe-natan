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
</head>
<body>

<h1>Cafe Natan</h1>

<hr>

<h3>Receipt #<?= $transaksi["id"] ?></h3>

<p>
Tanggal:
<?= $transaksi["created_at"] ?>
</p>

<hr>

<?php while($item = mysqli_fetch_assoc($result_detail)): ?>

<p>

<?= $item["nama_menu"] ?>

x<?= $item["jumlah"] ?>

=

Rp <?= number_format($item["subtotal"], 0, ',', '.') ?>

</p>

<?php endwhile; ?>

<hr>

<h3>

Total:

Rp <?= number_format(
    $transaksi["total_harga"],
    0,
    ',',
    '.'
) ?>

</h3>

<hr>

<p>
Terima Kasih 😊
</p>

<a href="kasir.php">
    Kembali ke Kasir
</a>

</body>
</html>