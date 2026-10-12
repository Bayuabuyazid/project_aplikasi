<?php
require 'koneksi.php';

if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    header('Location: riwayat.php');
    exit;
}

$id = (int) $_GET['id'];

$query = "DELETE FROM data_poin_siswa WHERE id = $id";

mysqli_query($koneksi, $query);

header('Location: riwayat.php');
exit;
?>
