<?php

include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Akses halaman ini melalui form tambah poin.");
}

$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$jurusan = $_POST['jurusan'];
$pelanggaran = $_POST['pelanggaran'];
$poin = $_POST['poin'];

$query = "INSERT INTO data_poin_siswa
          (Nama, Kelas, Jurusan, Pelanggaran, poin)
          VALUES
          ('$nama', '$kelas', '$jurusan', '$pelanggaran', '$poin')";

if (mysqli_query($koneksi, $query)) {
    echo "Data berhasil ditambahkan!";
} else {
    echo "Gagal menambahkan data: " . mysqli_error($koneksi);
}

?>