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
        :root {
            color-scheme: light;
            --primary: #155eef;
            --primary-dark: #1849a9;
            --ink: #172b4d;
            --line: #d7e2f0;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            padding: 48px 20px;
            font-family: "Segoe UI", Tahoma, sans-serif;
            color: var(--ink);
            background: linear-gradient(145deg, #f5f9ff 0%, #fff 55%, #eaf3ff 100%);
        }

        .edit-card {
            width: min(100%, 720px);
            margin: 0 auto;
            overflow: hidden;
            border: 1px solid #e4ecf6;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 20px 55px rgba(25, 65, 120, 0.12);
        }

        .card-header {
            padding: 30px clamp(22px, 5vw, 38px);
            background: linear-gradient(120deg, #155eef, #2e90fa);
            color: #fff;
        }

        .eyebrow {
            margin: 0 0 8px;
            color: #dbeafe;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            font-size: clamp(1.5rem, 4vw, 1.9rem);
            letter-spacing: -0.03em;
        }

        .card-header p:last-child {
            margin: 8px 0 0;
            color: #eaf2ff;
            font-size: 0.95rem;
        }

        form {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
            padding: clamp(22px, 5vw, 38px);
        }

        .field {
            min-width: 0;
        }

        .field-full,
        .form-actions {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #344563;
            font-size: 0.9rem;
            font-weight: 600;
        }

        input,
        select,
        textarea {
            width: 100%;
            min-height: 46px;
            padding: 11px 13px;
            border: 1px solid var(--line);
            border-radius: 8px;
            outline: none;
            background: #fff;
            color: var(--ink);
            font: inherit;
            font-size: 0.96rem;
            transition: border-color 160ms ease, box-shadow 160ms ease;
        }

        textarea {
            min-height: 116px;
            resize: vertical;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(21, 94, 239, 0.14);
        }

        .form-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
            padding-top: 4px;
        }

        .button {
            display: inline-flex;
            min-height: 46px;
            align-items: center;
            justify-content: center;
            padding: 0 18px;
            border: 1px solid transparent;
            border-radius: 7px;
            cursor: pointer;
            font: inherit;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 160ms ease, box-shadow 160ms ease, transform 160ms ease;
        }

        .button-primary {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 5px 12px rgba(21, 94, 239, 0.2);
        }

        .button-primary:hover {
            background: var(--primary-dark);
            box-shadow: 0 7px 16px rgba(21, 94, 239, 0.25);
            transform: translateY(-1px);
        }

        .button-secondary {
            border-color: var(--line);
            background: #fff;
            color: #344563;
        }

        .button-secondary:hover {
            background: #f5f8fc;
        }

        .button:focus-visible {
            outline: 3px solid #b2ccff;
            outline-offset: 3px;
        }

        @media (max-width: 560px) {
            body {
                padding: 24px 14px;
            }

            form {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .field-full,
            .form-actions {
                grid-column: auto;
            }

            .form-actions {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <main class="edit-card">
        <header class="card-header">
            <p class="eyebrow">Manajemen data siswa</p>
            <h1>Edit Data Poin Siswa</h1>
            <p>Perbarui informasi siswa dan catatan pelanggaran.</p>
        </header>

        <form method="POST" action="edit_poin.php">
            <input type="hidden" name="id" value="<?php echo (int) $data['id']; ?>">

            <div class="field">
                <label for="nama">Nama Siswa</label>
                <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($data['Nama']); ?>" required>
            </div>

            <div class="field">
                <label for="kelas">Kelas</label>
                <input type="text" id="kelas" name="kelas" value="<?php echo htmlspecialchars($data['Kelas']); ?>" required>
            </div>

            <div class="field">
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
            </div>

            <div class="field">
                <label for="poin">Jumlah Poin</label>
                <input type="number" id="poin" name="poin" value="<?php echo (int) $data['poin']; ?>" required>
            </div>

            <div class="field field-full">
                <label for="pelanggaran">Pelanggaran</label>
                <textarea id="pelanggaran" name="pelanggaran" rows="4" required><?php echo htmlspecialchars($data['Pelanggaran']); ?></textarea>
            </div>

            <div class="form-actions">
                <a class="button button-secondary" href="riwayat.php">Kembali ke Riwayat</a>
                <button class="button button-primary" type="submit">Simpan Perubahan</button>
            </div>
        </form>
    </main>
</body>
</html>
