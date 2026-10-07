<?php

include "koneksi.php";

$id = $_GET['id'];

$query = "DELETE FROM poin WHERE id = '$id'";

mysqli_query($koneksi, $query);

header("Location: riwayat.php");
exit;

?>