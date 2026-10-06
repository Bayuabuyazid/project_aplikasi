<tbody>
<?php

$koneksi = new mysqli("localhost", "root", "", "e_poin");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$query = $koneksi->query("SELECT * FROM data_poin_siswa");

$no = 1;

if ($query->num_rows > 0) {

    while ($data = $query->fetch_assoc()) {
?>

<tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $data['Nama']; ?></td>
    <td><?php echo $data['Pelanggaran']; ?></td>
    <td><?php echo $data['poin']; ?></td>
</tr>

<?php
    }

} else {
    echo "<tr><td colspan='4'>Belum ada data</td></tr>";
}

$koneksi->close();

?>
</tbody>