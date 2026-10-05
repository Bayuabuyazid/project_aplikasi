<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Poin Siswa</title>
</head>
<body>
    <header>
        <h1>Riwayat Poin Siswa</h1>
        <p>Daftar Pelanggaran Siswa</p>
        </header>

        <section>
            <h2>Daftar Pelanggaran</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Pelanggaran</th>
                        <th>Poin</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Koneksi ke database
                    $koneksi = new mysqli("localhost", "root", "", "e_poin");

                    // Cek koneksi
                    if ($koneksi->connect_error) {
                        die("Koneksi gagal: " . $koneksi->connect_error);
                    }

                    // Query untuk mengambil data pelanggaran
                  $query = $koneksi->query("SELECT * FROM data_poin_siswa");

if ($query->num_rows > 0) {

    while ($data = $query->fetch_assoc()) {
        ?>

        <tr>
            <td><?php echo $data['Nama']; ?></td>
            <td><?php echo $data['Kelas']; ?></td>
            <td><?php echo $data['Jurusan']; ?></td>
            <td><?php echo $data['Pelanggaran']; ?></td>
            <td><?php echo $data['poin']; ?></td>
        </tr>

        <?php
    }

} else {
    echo "<tr><td colspan='5'>Belum ada data</td></tr>";
                
                    }

                    // Tutup koneksi
                    $koneksi->close();
                    ?>
                </tbody>
            </table>
</body>
</html>