<?php

session_start();

require 'config.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT *
              FROM admin
              WHERE username = '$username'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {

        $admin = mysqli_fetch_assoc($result);

        if (password_verify($password, $admin["password"])) {

            $_SESSION["admin"] = $admin["username"];

            header("Location: dashboard.php");
            exit;

        } else {

            $error = "Password salah!";

        }

    } else {

        $error = "Username tidak ditemukan!";

    }

}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Login Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="login-wrapper">
        <div class="form-card">
            <h1>Cafe Natan</h1>
            <p class="tagline">Cashier Management System</p>

            <?php if ($error): ?>
                <div class="alert-error"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
                <button type="submit" class="btn-login">Login</button>
            </form>
        </div>
    </div>
</body>

</html>