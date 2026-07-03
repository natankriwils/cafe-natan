<?php

$conn = mysqli_connect (
    "localhost",
    "root",
    "",
    "cafe_natan"
);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}