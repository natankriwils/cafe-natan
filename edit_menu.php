<?php

session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

require 'config.php';

$id = $_GET["id"];

$query = "SELECT * FROM menu WHERE id = $id";

$result = mysqli_query($conn, $query);

$menu = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama_menu = $_POST["nama_menu"];
    $harga = $_POST["harga"];

    $query = "UPDATE menu
              SET nama_menu='$nama_menu',
                  harga='$harga'
              WHERE id=$id";

    mysqli_query($conn, $query);

    header("Location: menu.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Menu</title>
</head>
<body>

<h1>Edit Menu</h1>

<form method="POST">

    <label>Nama Menu</label><br>
    <input
        type="text"
        name="nama_menu"
        value="<?= $menu['nama_menu'] ?>"
        required
    >

    <br><br>

    <label>Harga</label><br>
    <input
        type="number"
        name="harga"
        value="<?= $menu['harga'] ?>"
        required
    >

    <br><br>

    <button type="submit">
        Simpan Perubahan
    </button>

</form>

<br>

<a href="menu.php">Kembali</a>

</body>
</html>