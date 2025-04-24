<?php
session_start();
include 'config.php';

// Initialize variables
$feedback = "";
$subject_columns = [];

// Make sure user is logged in
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header("Location: landingp.php");
    exit;
}

// Get all available subject columns from nilaisiswa table
$columns_query = "SHOW COLUMNS FROM nilaisiswa";
$columns_result = mysqli_query($db, $columns_query);

if ($columns_result) {
    while ($column = mysqli_fetch_assoc($columns_result)) {
        // Exclude non-subject columns like id, nama, etc.
        if (!in_array($column['Field'], ['id', 'nama'])) {
            $subject_columns[] = $column['Field'];
        }
    }
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_nilai'])) {
        // Update student grades
        $nisn = $_POST['nisn'] ?? '';
        $nilai_data = $_POST['nilai'] ?? [];
        
        if ($nisn && !empty($nilai_data)) {
            // Get student name from NISN
            $query = "SELECT nama FROM siswa WHERE nisn = ?";
            $stmt = mysqli_prepare($db, $query);
            mysqli_stmt_bind_param($stmt, 's', $nisn);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $nama_siswa = $row['nama'];

                // Check if student exists in nilaisiswa table
                $cek_nama = mysqli_prepare($db, "SELECT nama FROM nilaisiswa WHERE nama = ?");
                mysqli_stmt_bind_param($cek_nama, 's', $nama_siswa);
                mysqli_stmt_execute($cek_nama);
                $res_cek = mysqli_stmt_get_result($cek_nama);

                if (mysqli_num_rows($res_cek) > 0) {
                    // Build the update query
                    $update_sets = [];
                    foreach ($nilai_data as $mapel => $nilai) {
                        if (in_array($mapel, $subject_columns)) {
                            $mapel = mysqli_real_escape_string($db, $mapel);
                            $nilai = mysqli_real_escape_string($db, $nilai);
                            $update_sets[] = "`$mapel` = '$nilai'";
                        }
                    }
                    
                    if (!empty($update_sets)) {
                        $query_update = "UPDATE nilaisiswa SET " . implode(", ", $update_sets) . " WHERE nama = ?";
                        $stmt2 = mysqli_prepare($db, $query_update);
                        mysqli_stmt_bind_param($stmt2, 's', $nama_siswa);

                        if (mysqli_stmt_execute($stmt2)) {
                            $feedback = "✅ Nilai untuk $nama_siswa berhasil diupdate.";
                        } else {
                            $feedback = "❌ Gagal mengupdate nilai: " . mysqli_error($db);
                        }
                    }
                } else {
                    // Prepare columns and values for insert
                    $insert_columns = ['nama'];
                    $insert_values = ["'$nama_siswa'"];
                    
                    foreach ($nilai_data as $mapel => $nilai) {
                        if (in_array($mapel, $subject_columns)) {
                            $mapel = mysqli_real_escape_string($db, $mapel);
                            $nilai = mysqli_real_escape_string($db, $nilai);
                            $insert_columns[] = "`$mapel`";
                            $insert_values[] = "'$nilai'";
                        }
                    }
                    
                    if (count($insert_columns) > 1) {
                        $query_insert = "INSERT INTO nilaisiswa (" . implode(", ", $insert_columns) . ") VALUES (" . implode(", ", $insert_values) . ")";
                        if (mysqli_query($db, $query_insert)) {
                            $feedback = "✅ Nilai untuk $nama_siswa berhasil ditambahkan.";
                        } else {
                            $feedback = "❌ Gagal menambahkan nilai baru: " . mysqli_error($db);
                        }
                    }
                }
            } else {
                $feedback = "❌ NISN tidak ditemukan.";
            }
        } else {
            $feedback = "⚠️ Data belum lengkap.";
        }
    } elseif (isset($_POST['hapus'])) {
        // Delete grades for a student
        $nisn = $_POST['nisn'] ?? '';

        if ($nisn) {
            // Get student name from NISN
            $query = "SELECT nama FROM siswa WHERE nisn = ?";
            $stmt = mysqli_prepare($db, $query);
            mysqli_stmt_bind_param($stmt, 's', $nisn);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $nama = $row['nama'];

                // Delete record from nilaisiswa table
                $query_hapus = "DELETE FROM nilaisiswa WHERE nama = ?";
                $stmt_hapus = mysqli_prepare($db, $query_hapus);
                mysqli_stmt_bind_param($stmt_hapus, 's', $nama);

                if (mysqli_stmt_execute($stmt_hapus)) {
                    $feedback = "✅ Semua nilai untuk siswa berhasil dihapus.";
                } else {
                    $feedback = "❌ Gagal menghapus nilai: " . mysqli_error($db);
                }
            } else {
                $feedback = "❌ NISN tidak ditemukan.";
            }
        } else {
            $feedback = "⚠️ Data tidak lengkap.";
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <title>Admin Nilai Siswa - SMKN 1 Jakarta</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            overflow-x: auto;
            display: block;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            border-right: none;
            border-left: none;
        }

        table th {
            background-color: #f2f2f2;
            position: sticky;
            top: 0;
        }

        table input[type="number"] {
            width: 60px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .nilai-cell {
            text-align: center;
        }

        .action-cell {
            white-space: nowrap;
            text-align: center;
        }

        .btn-save, .btn-delete {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            margin: 0 2px;
        }

        .btn-delete {
            background-color: #e74c3c;
        }

        /* Responsive table styling */
        @media screen and (max-width: 992px) {
            table {
                max-width: 100%;
            }
        }

        @media screen and (max-width: 768px) {
            .action-cell button {
                display: block;
                width: 100%;
                margin: 2px 0;
            }
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
            <a href="tmpadmin.php">Beranda</a>
            <a href="tmpadmin.php#profil">Profil</a>
            <a href="tmpadmin.php#programs">Program Keahlian</a>
            <a href="tmpadmin.php#berita">Berita</a>
            <a href="nilaisiswa2.php">Nilai Siswa</a>
            <a>Nilai Guru</a>
            <a href="dashboard.php" class="logout">Dashboard</a>
        </div>
        <div class="hamburger">
            <i class="fas fa-bars"></i>
        </div>
    </nav>
    <div class="container">

        <?php if (strpos($feedback, "✅") !== false): ?>
            <div class="success-message"><?= $feedback ?></div>
        <?php elseif (strpos($feedback, "❌") !== false || strpos($feedback, "⚠️") !== false): ?>
            <div class="error-message"><?= $feedback ?></div>
        <?php elseif (!empty($feedback)): ?>
            <div class="info-message"><?= $feedback ?></div>
        <?php endif; ?>

        <div class="header">
            <h1>Admin Panel - Manajemen Nilai Siswa</h1>
            <a href="tmpawalg.php" class="logout">Kembali</a>
        </div>

        <?php if (!empty($_SESSION['user']['nama'])): ?>
            <div class="welcome-message">
                👋 Selamat datang, <strong><?= htmlspecialchars($_SESSION['user']['nama']) ?></strong>!
            </div>
        <?php endif; ?>

        <!-- Student Search Form -->
        <form method="get" style="margin-top: 20px;">
            <input type="text" name="cari_nisn" placeholder="Cari NISN" value="<?= htmlspecialchars($_GET['cari_nisn'] ?? '') ?>">
            <input type="text" name="cari_nama" placeholder="Cari Nama" value="<?= htmlspecialchars($_GET['cari_nama'] ?? '') ?>">
            <input type="text" name="cari_kelas" placeholder="Cari Kelas" value="<?= htmlspecialchars($_GET['cari_kelas'] ?? '') ?>">
            <button type="submit">Cari</button>
        </form>

        <!-- Student Grades Table with All Subjects -->
        
        <?php if (count($subject_columns) > 0): ?>
            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>NISN</th>
                            <th>Nama</th>
                            <?php foreach ($subject_columns as $column): ?>
                                <th>Nilai <?= htmlspecialchars($column) ?></th>
                            <?php endforeach; ?>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Build WHERE clause for search
                        $where_clause = "1=1";

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

                                // Start form for this student
                                echo "<form method='post'>";
                                echo "<tr>";
                                echo "<td>$nisn</td>";
                                echo "<td>$nama</td>";
                                echo "<input type='hidden' name='nisn' value='$nisn'>";

                                // Get current values for all subjects
                                $query_nilai = "SELECT * FROM nilaisiswa WHERE nama = '" . mysqli_real_escape_string($db, $nama) . "'";
                                $result_nilai = mysqli_query($db, $query_nilai);
                                $nilai_siswa = [];

                                if ($result_nilai && mysqli_num_rows($result_nilai) > 0) {
                                    $nilai_siswa = mysqli_fetch_assoc($result_nilai);
                                }

                                // Display all subjects with form fields
                                foreach ($subject_columns as $column) {
                                    $nilai_sekarang = isset($nilai_siswa[$column]) ? $nilai_siswa[$column] : '';
                                    echo "<td class='nilai-cell'>";
                                    
                                    // Jika kolom adalah "kelas", tampilkan nilai kelas dari tabel siswa
                                    if ($column === "kelas") {
                                        echo htmlspecialchars($baris['kelas']); // Menampilkan kelas dari data siswa
                                    } else {
                                        // Untuk kolom nilai lainnya, tetap gunakan input
                                        echo "<input type='number' name='nilai[$column]' min='0' max='100' value='$nilai_sekarang'>";
                                    }
                                    
                                    echo "</td>";
                                }
                                
                                // Add action column
                                echo "<td class='action-cell'>";
                                echo "<button type='submit' name='update_nilai' class='btn-save'>Simpan</button>";
                                echo "<button type='submit' name='hapus' class='btn-delete' onclick='return confirm(\"Yakin ingin menghapus nilai siswa ini?\")'>Hapus</button>";
                                echo "</td>";
                                
                                echo "</tr>";
                                echo "</form>";
                            }
                        } else {
                            echo "<tr><td colspan='" . (3 + count($subject_columns)) . "'>Tidak ada data yang ditemukan.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="info-message">
                Tambahkan mata pelajaran terlebih dahulu untuk mengelola nilai siswa.
            </div>
        <?php endif; ?>

    </div>

    <script>
        // JavaScript for responsive navigation menu
        document.querySelector('.hamburger').addEventListener('click', function() {
            document.querySelector('.nav-menu').classList.toggle('active');
        });
    </script>

</body>
</html>