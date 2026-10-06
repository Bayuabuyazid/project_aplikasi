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
            </tr>
        </thead>

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
                <td><?php echo $data['Kelas']; ?></td>
                <td><?php echo $data['Jurusan']; ?></td>
                <td><?php echo $data['Pelanggaran']; ?></td>
                <td><?php echo $data['poin']; ?></td>
            </tr>

        <?php

            }

        } else {

            echo "<tr>";
            echo "<td colspan='6'>Belum ada data</td>";
            echo "</tr>";

        }

        $koneksi->close();

        ?>

        </tbody>

    </table>

    <a class="kembali" href="index.html">← Kembali ke Tambah Poin</a>

</section>

</body>
</html>