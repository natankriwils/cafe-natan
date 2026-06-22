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
</head>
<body>

<h1>Dashboard Admin</h1>

<p>Selamat datang, <?= $_SESSION["admin"] ?></p>

<a href="kasir.php">
    kasir
</a>

<br><br>

<a href="menu.php">
    Kelola Menu
</a>

<br><br>

<a href="riwayat.php">
    Riwayat Pembelian
</a>

<br><br>

<a href="logout.php">
    Logout
</a>

</body>
</html>