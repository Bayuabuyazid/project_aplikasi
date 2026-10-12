<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Akses halaman ini melalui form tambah poin.');
}

$nama = mysqli_real_escape_string($koneksi, $_POST['nama'] ?? '');
$kelas = mysqli_real_escape_string($koneksi, $_POST['kelas'] ?? '');
$jurusan = mysqli_real_escape_string($koneksi, $_POST['jurusan'] ?? '');
$pelanggaran = mysqli_real_escape_string($koneksi, $_POST['pelanggaran'] ?? '');
$poin = (int)($_POST['poin'] ?? 0);

$query = "INSERT INTO data_poin_siswa (Nama, Kelas, Jurusan, Pelanggaran, poin)
          VALUES ('$nama', '$kelas', '$jurusan', '$pelanggaran', '$poin')";

if (mysqli_query($koneksi, $query)) {
    header('Location: riwayat.php');
    exit;
}

 die('Gagal menambahkan data: ' . mysqli_error($koneksi));
?>