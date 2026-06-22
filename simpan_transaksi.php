<?php

session_start();

require 'config.php';

if (empty($_SESSION["keranjang"])) {

    header("Location: kasir.php");
    exit;

}

$total = 0;

foreach ($_SESSION["keranjang"] as $id => $jumlah) {

    $query = "SELECT * FROM menu WHERE id = $id";

    $result = mysqli_query($conn, $query);

    $menu = mysqli_fetch_assoc($result);

    $subtotal = $menu["harga"] * $jumlah;

    $total += $subtotal;

}

$query = "INSERT INTO transaksi (total_harga)
VALUES ($total)";

mysqli_query($conn, $query);

$transaksi_id = mysqli_insert_id($conn);

foreach ($_SESSION["keranjang"] as $id => $jumlah) {

    $query = "SELECT * FROM menu WHERE id = $id";

    $result = mysqli_query($conn, $query);

    $menu = mysqli_fetch_assoc($result);

    $subtotal = $menu["harga"] * $jumlah;

    $query = "INSERT INTO detail_transaksi
              (transaksi_id, menu_id, jumlah, subtotal)

              VALUES

              ($transaksi_id,
               $id,
               $jumlah,
               $subtotal)";

    mysqli_query($conn, $query);

}

unset($_SESSION["keranjang"]);

header("Location: receipt.php?id=$transaksi_id");
exit;