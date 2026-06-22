<?php

session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

require 'config.php';

$id = $_GET["id"];

$query = "DELETE FROM menu WHERE id = $id";

mysqli_query($conn, $query);

header("Location: menu.php");
exit;