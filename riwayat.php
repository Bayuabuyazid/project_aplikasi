<?php
require 'koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM data_poin_siswa ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Poin Siswa</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #3f7ec5;
            color: white;
            text-align: center;
            padding: 25px;
        }

        section {
            width: 90%;
            margin: 30px auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #296abf;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        .action a {
            color: #296abf;
            text-decoration: none;
            font-weight: bold;
        }

        .action a:hover {
            text-decoration: underline;
        }

        .kembali {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #3763c1;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
    </style>
</head>

<body>

<header>
    <h1>Riwayat Poin Siswa</h1>
    <p>Daftar Pelanggaran Siswa</p>
</header>

<section>
    <h2>Daftar Pelanggaran</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Pelanggaran</th>
                <th>Poin</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        <?php
        $no = 1;

        if (mysqli_num_rows($query) > 0) {
            while ($data = mysqli_fetch_assoc($query)) {
        ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($data['Nama']); ?></td>
                    <td><?php echo htmlspecialchars($data['Kelas']); ?></td>
                    <td><?php echo htmlspecialchars($data['Jurusan']); ?></td>
                    <td><?php echo htmlspecialchars($data['Pelanggaran']); ?></td>
                    <td><?php echo htmlspecialchars($data['poin']); ?></td>
                    <td class="action">
                        <a href="edit_poin.php?id=<?php echo (int) $data['id']; ?>">Edit</a> |
                        <a href="hapus_poin.php?id=<?php echo (int) $data['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='7'>Belum ada data</td></tr>";
        }
        ?>
        </tbody>
    </table>

    <a class="kembali" href="index.html">← Kembali ke Tambah Poin</a>
</section>

</body>
</html>