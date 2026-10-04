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
                    $conn = new mysqli("localhost", "username", "password", "database_name");

                    // Cek koneksi
                    if ($conn->connect_error) {
                        die("Koneksi gagal: " . $conn->connect_error);
                    }

                    // Query untuk mengambil data pelanggaran
                    $sql = "SELECT * FROM pelanggaran";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $no = 1;
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $row["nama_siswa"] . "</td>";
                            echo "<td>" . $row["pelanggaran"] . "</td>";
                            echo "<td>" . $row["poin"] . "</td>";
                            echo "<td>" . $row["tanggal"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Tidak ada data pelanggaran.</td></tr>";
                    }

                    // Tutup koneksi
                    $conn->close();
                    ?>
                </tbody>
            </table>
</body>
</html>