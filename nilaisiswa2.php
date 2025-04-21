<?php
session_start();
include 'config.php';

// Cek apakah user login (baik siswa atau admin)
$is_logged_in = isset($_SESSION['role']);
$is_siswa = $is_logged_in && $_SESSION['role'] === 'siswa';
$is_admin = $is_logged_in && $_SESSION['role'] === 'admin';

// Inisialisasi variabel filter
$filter_nama = isset($_GET['nama']) ? trim($_GET['nama']) : '';
$filter_kelas = isset($_GET['kelas']) ? trim($_GET['kelas']) : '';

// Query awal tanpa filter
$query = "SELECT nama, kelas, produktif, ipas, olga, b_indo, b_inggris, matematika FROM nilaisiswa WHERE 1=1";

// Jika user sudah login, baru bisa filter data
if ($is_logged_in) {
    if (!empty($filter_nama)) {
        $safe_nama = mysqli_real_escape_string($db, $filter_nama);
        $query .= " AND nama LIKE '%$safe_nama%'";
    }

    if (!empty($filter_kelas)) {
        $safe_kelas = mysqli_real_escape_string($db, $filter_kelas);
        $query .= " AND kelas LIKE '%$safe_kelas%'";
    }
}

$result = mysqli_query($db, $query);

// Cek jika query berhasil
if (!$result) {
    die("Error database: " . mysqli_error($db));
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Nilai Siswa - SMKN 1 Jakarta</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/nilaisiswa.css?v=3">
</head>

<body>

    <nav>
        <div class="logname" id="nav">
            <img src="img/smkn1-jakarta.png" alt="Logo SMKN 1 Jakarta">
            <h1>SMKN 1 JAKARTA</h1>
        </div>
        <div class="nav-menu">
            <a href="tmpadmin.php #beranda">Beranda</a>
            <a href="tmpadmin.php #profil">Profil</a>
            <a href="tmpadmin.php #programs">Program Keahlian</a>
            <a href="tmpadmin.php #berita">Berita</a>
            <a>Nilai</a>
            <?php if ($is_logged_in): ?>
                <a href="dashboard.php">Dashboard</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </div>
        <div class="hamburger">
            <i class="fas fa-bars"></i>
        </div>
    </nav>

    <div class="container">
        <div class="header">
            <h1>Data Siswa SMKN 1 Jakarta</h1>
            <a href="tmpawal.php" class="logout">Kembali</a>
        </div>

        <!-- Form Pencarian -->
        <?php if ($is_logged_in): ?>
            <form method="GET">
                <input type="text" name="nama" placeholder="Cari berdasarkan nama" value="<?php echo htmlspecialchars($filter_nama); ?>">
                <input type="text" name="kelas" placeholder="Cari berdasarkan kelas" value="<?php echo htmlspecialchars($filter_kelas); ?>">
                <button type="submit">Cari</button>
            </form>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Mapel Jurusan</th>
                    <th>Ipas</th>
                    <th>Olga</th>
                    <th>B Indo</th>
                    <th>B Inggris</th>
                    <th>Matematika</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td><?php echo htmlspecialchars($row['kelas']); ?></td>
                        <td><?php echo htmlspecialchars($row['produktif']); ?></td>
                        <td><?php echo htmlspecialchars($row['ipas']); ?></td>
                        <td><?php echo htmlspecialchars($row['olga']); ?></td>
                        <td><?php echo htmlspecialchars($row['b_indo']); ?></td>
                        <td><?php echo htmlspecialchars($row['b_inggris']); ?></td>
                        <td><?php echo htmlspecialchars($row['matematika']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>