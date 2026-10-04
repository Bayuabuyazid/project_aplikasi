<?php

include "koneksi.php";

$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$jurusan = $_POST['jurusan'];
$pelanggaran = $_POST['pelanggaran'];
$poin = $_POST['poin'];

$query = "INSERT INTO data_poin_siswa 
          (nama, kelas, jurusan, pelanggaran, poin)
          VALUES 
          ('$nama', '$kelas', '$jurusan', '$pelanggaran', '$poin')";

mysqli_query($koneksi, $query);

if (mysqli_query($koneksi, $query)) {
    echo "Data berhasil ditambahkan!";
} else {
    echo "Gagal menambahkan data: " . mysqli_error($koneksi);
}

?>