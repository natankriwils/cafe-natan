<?php

session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama_menu = $_POST["nama_menu"];
    $harga = $_POST["harga"];

    $query = "INSERT INTO menu (nama_menu, harga)
              VALUES ('$nama_menu', '$harga')";

    mysqli_query($conn, $query);

    header("Location: menu.php");
    exit;
}

$query = "SELECT * FROM menu";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Menu</title>

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
    <h1>Kelola Menu</h1>
    <p class="tagline">Tambah atau kelola daftar menu cafe</p>
</section>

<div class="container">

    <div class="edit-card">

        <form method="POST" class="edit-body">
            <label>Nama Menu</label>
            <input type="text" name="nama_menu" class="form-control" required>

            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>

            <button type="submit" class="btn-save">Tambah Menu</button>
        </form>

    </div>

    <hr class="section-divider">
    <h2 class="section-title">Daftar Menu</h2>

    <div class="menu-list">

        <?php while ($row = mysqli_fetch_assoc($result)): ?>

            <div class="menu-list-card">

                <div class="menu-info">
                    <h4><?= $row["nama_menu"] ?></h4>
                    <p>Rp <?= number_format($row["harga"], 0, ',', '.') ?></p>
                </div>

                <div class="menu-action">
                    <a href="edit_menu.php?id=<?= $row["id"] ?>" class="btn-card">Edit</a>
                    <a href="hapus_menu.php?id=<?= $row["id"] ?>" class="btn-card btn-delete">Hapus</a>
                </div>

            </div>

        <?php endwhile; ?>

    </div>

</div>

</body>

</html>
