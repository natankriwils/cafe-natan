<?php

session_start();

$id = $_GET["id"];

if (!isset($_SESSION["keranjang"])) {
    $_SESSION["keranjang"] = [];
}

if (isset($_SESSION["keranjang"][$id])) {

    $_SESSION["keranjang"][$id]++;

} else {

    $_SESSION["keranjang"][$id] = 1;

}

header("Location: kasir.php");
exit;