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

    <div class="login-wrapper">
        <div class="form-card">
            <h1 class="login-title">
                Edit Menu
            </h1>
            <p class="edit-menu-subtitle">
                Ubah informasi menu cafe
            </p>
            <form method="POST">
                <label>Nama Menu</label>
                <input type="text" name="nama_menu" class="edit-form-control" value="<?= $menu['nama_menu'] ?>" required>

                <label>Harga</label>

                <input
                    type="number"
                    name="harga"
                    class="edit-form-control"
                    value="<?= $menu['harga'] ?>"
                    required>

                <button
                    type="submit"
                    class="btn-save">
                    Simpan Perubahan
                </button>

            </form>

            <a
                href="menu.php"
                class="btn-card back-btn">
                Kembali
            </a>

        </div>

    </div>

</body>

</html>
