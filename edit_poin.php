<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) ($_POST['id'] ?? 0);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama'] ?? '');
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas'] ?? '');
    $jurusan = mysqli_real_escape_string($koneksi, $_POST['jurusan'] ?? '');
    $pelanggaran = mysqli_real_escape_string($koneksi, $_POST['pelanggaran'] ?? '');
    $poin = (int)($_POST['poin'] ?? 0);

    if ($id > 0) {
        $query = "UPDATE data_poin_siswa SET Nama = '$nama', Kelas = '$kelas', Jurusan = '$jurusan', Pelanggaran = '$pelanggaran', poin = '$poin' WHERE id = $id";

        if (mysqli_query($koneksi, $query)) {
            header('Location: riwayat.php');
            exit;
        }

        die('Gagal mengubah data: ' . mysqli_error($koneksi));
    }
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    header('Location: riwayat.php');
    exit;
}

$result = mysqli_query($koneksi, "SELECT * FROM data_poin_siswa WHERE id = $id");

if (mysqli_num_rows($result) === 0) {
    header('Location: riwayat.php');
    exit;
}

$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Poin Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        section {
            width: 50%;
            margin: 40px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #296abf;
        }

        label {
            display: block;
            margin-top: 12px;
            font-weight: bold;
        }

        input, select, textarea, button {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            box-sizing: border-box;
        }

        button {
            background: #296abf;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 20px;
        }

        .link {
            display: inline-block;
            margin-top: 20px;
            color: #296abf;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <section>
        <h2>Edit Data Poin Siswa</h2>

        <form method="POST" action="edit_poin.php">
            <input type="hidden" name="id" value="<?php echo (int) $data['id']; ?>">

            <label for="nama">Nama Siswa</label>
            <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($data['Nama']); ?>" required>

            <label for="kelas">Kelas</label>
            <input type="text" id="kelas" name="kelas" value="<?php echo htmlspecialchars($data['Kelas']); ?>" required>

            <label for="jurusan">Jurusan</label>
            <select name="jurusan" id="jurusan">
                <?php
                $jurusanList = ['RPL', 'LP', 'MP', 'AK', 'BD'];
                foreach ($jurusanList as $jurusanOption) {
                    $selected = ($data['Jurusan'] === $jurusanOption) ? 'selected' : '';
                    echo "<option value=\"$jurusanOption\" $selected>$jurusanOption</option>";
                }
                ?>
            </select>

            <label for="pelanggaran">Pelanggaran</label>
            <textarea id="pelanggaran" name="pelanggaran" rows="4" required><?php echo htmlspecialchars($data['Pelanggaran']); ?></textarea>

            <label for="poin">Jumlah Poin</label>
            <input type="number" id="poin" name="poin" value="<?php echo (int) $data['poin']; ?>" required>

            <button type="submit">Simpan Perubahan</button>
        </form>

        <a class="link" href="riwayat.php">← Kembali ke Riwayat</a>
    </section>
</body>
</html>
