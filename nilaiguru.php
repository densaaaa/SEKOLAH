<?php
session_start();
include 'config.php';

// Inisialisasi awal
$feedback = "";

// Set mapel berdasarkan guru yang login - dalam kasus ini DPIB
if (isset($_SESSION['user']['nip'])) {
    $nip = $_SESSION['user']['nip'];
    $query = "SELECT mapel, mapel_jurusan FROM guru WHERE nip = '$nip'";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data_guru = mysqli_fetch_assoc($result);
        $mapel = $data_guru['mapel'];
        $jurusan = $data_guru['mapel_jurusan'];

        $_SESSION['user']['mapel'] = $mapel;
        $_SESSION['user']['mapel_jurusan'] = $jurusan;
    } else {
        $feedback = "❌ Data guru tidak ditemukan.";
        $mapel = '';
        $jurusan = '';
    }
} else {
    $feedback = "⚠️ Anda belum login sebagai guru.";
    $mapel = '';
    $jurusan = '';
}

$_SESSION['user']['mapel'] = $mapel;
$_SESSION['user']['mapel_jurusan'] = $jurusan;

// Get subject (mapel) from session
$mapel = $_SESSION['user']['mapel'] ?? '';
$jurusan = $_SESSION['user']['mapel_jurusan'] ?? '';

// Menentukan nama kolom nilai
$kolom_nilai = "produktif";


// Verifikasi kolom ada dalam database sebelum digunakan
if (!empty($kolom_nilai)) {
    $check_column_query = "SHOW COLUMNS FROM nilaisiswa LIKE '$kolom_nilai'";
    $check_column = mysqli_query($db, $check_column_query);
    if (mysqli_num_rows($check_column) == 0) {
        // Kolom tidak ada, tambahkan secara otomatis (opsional)
        $create_column = mysqli_query($db, "ALTER TABLE nilaisiswa ADD `$kolom_nilai` VARCHAR(5)");
        if ($create_column) {
            $feedback = "✅ Kolom nilai untuk nilai berhasil dibuat.";
        } else {
            $feedback = "❌ Gagal membuat kolom nilai: " . mysqli_error($db);
        }
    }
}

// Proses simpan / hapus
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nisn = $_POST['nisn'] ?? '';

    if (isset($_POST['hapus'])) {
        // Ambil nama berdasarkan NISN
        $query = "SELECT nama FROM nisn_to_nama WHERE nisn = ?";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, 's', $nisn);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $nama = $row['nama'];

            // UPDATE, bukan HAPUS
            $query_hapus = "UPDATE nilaisiswa SET $kolom_nilai = NULL WHERE nama = ?";
            $stmt_hapus = mysqli_prepare($db, $query_hapus);
            mysqli_stmt_bind_param($stmt_hapus, 's', $nama);

            if (mysqli_stmt_execute($stmt_hapus)) {
                $feedback = "✅ Nilai produktif berhasil dihapus.";
            } else {
                $feedback = "❌ Gagal menghapus nilai: " . mysqli_error($db);
            }
        } else {
            $feedback = "❌ NISN tidak ditemukan.";
        }
    } else {
        $nilai_field = "nilai_" . $kolom_nilai;
        $nilai = $_POST[$nilai_field] ?? '';

        if ($nisn && $nilai !== '') {
            // Cek apakah NISN ada di tabel nisn_to_nama
            $stmt = mysqli_prepare($db, "SELECT nama FROM nisn_to_nama WHERE nisn = ?");
            mysqli_stmt_bind_param($stmt, 's', $nisn);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $nama_siswa = $row['nama'];

                // Cek apakah nama siswa sudah ada di tabel nilaisiswa
                $cek_nama = mysqli_prepare($db, "SELECT nama FROM nilaisiswa WHERE nama = ?");
                mysqli_stmt_bind_param($cek_nama, 's', $nama_siswa);
                mysqli_stmt_execute($cek_nama);
                $res_cek = mysqli_stmt_get_result($cek_nama);

                if (mysqli_num_rows($res_cek) > 0) {
                    // Update nilai
                    $query_update = "UPDATE nilaisiswa SET $kolom_nilai = ? WHERE nama = ?";
                    $stmt2 = mysqli_prepare($db, $query_update);
                    mysqli_stmt_bind_param($stmt2, 'ss', $nilai, $nama_siswa);

                    if (mysqli_stmt_execute($stmt2)) {
                        $feedback = "✅ Nilai Produktif untuk $nama_siswa berhasil diupdate.";
                    } else {
                        $feedback = "❌ Gagal mengupdate nilai: " . mysqli_error($db);
                    }
                } else {
                    // Insert nilai baru
                    $query_insert = "INSERT INTO nilaisiswa (nama, $kolom_nilai) VALUES (?, ?)";
                    $stmt_insert = mysqli_prepare($db, $query_insert);
                    mysqli_stmt_bind_param($stmt_insert, 'ss', $nama_siswa, $nilai);

                    if (mysqli_stmt_execute($stmt_insert)) {
                        $feedback = "✅ Nilai Produktif untuk $nama_siswa berhasil ditambahkan.";
                    } else {
                        $feedback = "❌ Gagal menambahkan nilai baru: " . mysqli_error($db);
                    }
                }
            } else {
                $feedback = "❌ NISN tidak ditemukan.";
            }
        } else {
            $feedback = "⚠️ Data belum lengkap.";
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <title>Data Nilai Siswa - SMKN 1 Jakarta</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/nilaiguru.css?v=2">
    <style>
        .error-message {
            color: #e74c3c;
            background-color: #f9e7e7;
            border-left: 4px solid #e74c3c;
            padding: 10px;
            margin: 10px 0;
            font-weight: bold;
        }

        .info-message {
            color: #3498db;
            background-color: #e8f4f8;
            border-left: 4px solid #3498db;
            padding: 10px;
            margin: 10px 0;
        }

        .success-message {
            color: #27ae60;
            background-color: #e8f8ef;
            border-left: 4px solid #27ae60;
            padding: 10px;
            margin: 10px 0;
        }

        .mapel-info {
            font-size: 1.2em;
            margin-bottom: 15px;
        }

        .welcome-message {
            background: linear-gradient(to right, #dfe9f3, #ffffff);
            padding: 12px 20px;
            border-left: 5px solid #3498db;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 1.1em;
            color: #2c3e50;
            margin-top: 15px;
        }

    </style>
</head>

<body>

    <nav>
        <div class="logname" id="nav" href="nilaisiswa">
            <img src="img/smkn1-jakarta.png" alt="Logo SMKN 1 Jakarta">
            <h1>SMKN 1 JAKARTA</h1>
        </div>
        <div class="nav-menu">
            <a href="tmpawalg.php">Beranda</a>
            <a href="tmpawalg.php#profil">Profil</a>
            <a href="tmpawalg.php#programs">Program Keahlian</a>
            <a href="tmpawalg.php#berita">Berita</a>
            <a>Nilai</a>
            <a href="landingp.php" class="logout">Logout</a> <!-- Tambahin class -->
        </div>
        <div class="hamburger">
            <i class="fas fa-bars"></i>
        </div>
    </nav>
    <div class="container"> <!-- Tambahan bungkus -->

        <?php if (strpos($feedback, "✅") !== false): ?>
            <div class="success-message"><?= $feedback ?></div>
        <?php elseif (strpos($feedback, "❌") !== false || strpos($feedback, "⚠️") !== false): ?>
            <div class="error-message"><?= $feedback ?></div>
        <?php elseif (!empty($feedback)): ?>
            <div class="info-message"><?= $feedback ?></div>
        <?php endif; ?>

        <div class="header">
            <h1>Data Nilai Siswa SMKN 1 Jakarta</h1>
            <a href="tmpawal.php" class="logout">Kembali</a>
        </div>

        <?php if (!empty($_SESSION['user']['nama'])): ?>
    <div class="welcome-message">
        👋 Selamat datang, <strong><?= htmlspecialchars($_SESSION['user']['nama']) ?></strong>!
    </div>
<?php endif; ?>

        <form method="get" style="margin-top: 20px;">
            <input type="text" name="cari_nisn" placeholder="Cari NISN" value="<?= htmlspecialchars($_GET['cari_nisn'] ?? '') ?>">
            <input type="text" name="cari_nama" placeholder="Cari Nama" value="<?= htmlspecialchars($_GET['cari_nama'] ?? '') ?>">
            <input type="text" name="cari_kelas" placeholder="Cari Kelas" value="<?= htmlspecialchars($_GET['cari_kelas'] ?? '') ?>">
            <button type="submit">Cari</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Nilai Produktif</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Filter hanya untuk kelas dengan DPIB
                // Tentukan filter berdasarkan mapel
                if (in_array(strtolower($mapel), ['b. indonesia', 'b. inggris', 'ipas', 'olga', 'matematika'])) {
                    $where_clause = "1=1";
                } else {
                    $where_clause = "LOWER(kelas) LIKE '%" . strtolower($jurusan) . "%'";
                }

                if (!empty($_GET['cari_nisn'])) {
                    $cari_nisn = mysqli_real_escape_string($db, $_GET['cari_nisn']);
                    $where_clause .= " AND nisn LIKE '%$cari_nisn%'";
                }
                if (!empty($_GET['cari_nama'])) {
                    $cari_nama = mysqli_real_escape_string($db, $_GET['cari_nama']);
                    $where_clause .= " AND nama LIKE '%$cari_nama%'";
                }
                if (!empty($_GET['cari_kelas'])) {
                    $cari_kelas = mysqli_real_escape_string($db, $_GET['cari_kelas']);
                    $where_clause .= " AND kelas LIKE '%$cari_kelas%'";
                }

                $query = "SELECT * FROM siswa WHERE $where_clause ORDER BY kelas ASC, nama ASC";
                $hasil = mysqli_query($db, $query);

                if ($hasil && mysqli_num_rows($hasil) > 0) {
                    while ($baris = mysqli_fetch_assoc($hasil)) {
                        $nisn = $baris['nisn'];
                        $nama = $baris['nama'];
                        $kelas = $baris['kelas'];

                        $query_nilai = "SELECT $kolom_nilai FROM nilaisiswa WHERE nama = '" . mysqli_real_escape_string($db, $nama) . "'";
                        $result_nilai = mysqli_query($db, $query_nilai);
                        $nilai_sekarang = '';

                        if ($result_nilai && mysqli_num_rows($result_nilai) > 0) {
                            $row_nilai = mysqli_fetch_assoc($result_nilai);
                            $nilai_sekarang = $row_nilai[$kolom_nilai] ?? '';
                        }

                        echo "<tr><form method='post'>";
                        echo "<td>$nisn</td>";
                        echo "<td>$nama</td>";
                        echo "<td>$kelas</td>";
                        echo "<input type='hidden' name='nisn' value='$nisn'>";
                        echo "<td><input type='number' name='nilai_$kolom_nilai' min='0' max='100' value='$nilai_sekarang'></td>";
                        echo "<td>
                        <button type='submit' name='hapus'>Hapus</button>
                        <button type='submit'>Simpan</button>
                        </td>";
                        echo "</form></tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada data yang ditemukan.</td></tr>";
                }
                ?>
            </tbody>
        </table>

    </div>

</body>
</html>
