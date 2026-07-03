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

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar">

    <div class="container navbar-container">
        <a class="navbar-brand">Cafe Natan</a>
        <a href="menu.php" class="nav-link active">Kelola Menu</a>
    </div>

</nav>

<section class="hero">
    <h1>Edit Menu</h1>
    <p class="tagline">Ubah informasi menu cafe</p>
</section>

<div class="container">

    <div class="edit-card">

        <form method="POST" class="edit-body">
            <label>Nama Menu</label>
            <input type="text" name="nama_menu" class="form-control" value="<?= $menu["nama_menu"] ?>" required>
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="<?= $menu["harga"] ?>" required>
            <button type="submit" class="btn-save">Simpan Perubahan</button>
        </form>

    </div>

</div>

</body>

</html>