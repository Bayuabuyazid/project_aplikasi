<?php
$koneksi = mysqli_connect("localhost", "root", "", "e_poin");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>