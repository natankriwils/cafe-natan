<?php

session_start();

$id = $_GET["id"];

if (isset($_SESSION["keranjang"][$id])) {

    $_SESSION["keranjang"][$id]--;

    if ($_SESSION["keranjang"][$id] <= 0) {
        unset($_SESSION["keranjang"][$id]);
    }

}

header("Location: kasir.php");
exit;