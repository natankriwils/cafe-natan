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
</head>
<body>

<h1>Daftar Menu</h1>

<a href="dashboard.php">Dashboard</a>
<br><br>

<h2>Tambah Menu</h2>

<form method="POST">

    <label>Nama Menu</label><br>
    <input type="text" name="nama_menu" required>

    <br><br>

    <label>Harga</label><br>
    <input type="number" name="harga" required>

    <br><br>

    <button type="submit">
        Tambah Menu
    </button>

</form>

<hr>

<table border="1" cellpadding="10">

    <tr>
        <th>ID</th>
        <th>Nama Menu</th>
        <th>Harga</th>
        <th>Aksi</th>
    </tr>

    <?php while($row = mysqli_fetch_assoc($result)): ?>

    <tr>
        <td><?= $row["id"] ?></td>
        <td><?= $row["nama_menu"] ?></td>
        <td>Rp <?= number_format($row["harga"], 0, ',', '.') ?></td>
        <td>
            <a href="edit_menu.php?id=<?= $row['id'] ?>">
                Edit
            </a>

            |

            <a href="hapus_menu.php?id=<?= $row['id'] ?>">
                Hapus
            </a>
        </td>
    </tr>

    <?php endwhile; ?>

</table>

</body>
</html>