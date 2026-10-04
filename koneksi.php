<?php
$koneksi = mysqli_connect("localhost","root","","e_poin");
 
 if (mysqli_connect_errno()){
 	echo "Koneksi database gagal : " . mysqli_connect_error();

 }
  echo "Koneksi database berhasil";
?>