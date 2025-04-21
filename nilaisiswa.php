<?php
session_start();
include 'config.php';

// Cek jika user belum login, redirect ke halaman login
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'siswa') {
    header('Location: tmpawal.php');
    exit();
}

// Inisialisasi variabel filter
$filter_nama = isset($_GET['nama']) ? trim($_GET['nama']) : '';
$filter_kelas = isset($_GET['kelas']) ? trim($_GET['kelas']) : '';

// Query awal tanpa filter
$query = "SELECT nama, kelas, produktif, ipas, olga, b_indo, b_inggris, matematika FROM nilaisiswa WHERE 1=1";

// Filter hanya jika pencarian nama atau kelas dilakukan
if (!empty($filter_nama)) {
    $safe_nama = mysqli_real_escape_string($db, $filter_nama);
    $query .= " AND nama LIKE '%$safe_nama%'";
}

if (!empty($filter_kelas)) {
    $safe_kelas = mysqli_real_escape_string($db, $filter_kelas);
    $query .= " AND kelas LIKE '%$safe_kelas%'";
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
    <style>
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
            <a href="tmpawal.php">Beranda</a>
            <a href="tmpawal.php #profil">Profil</a>
            <a href="tmpawal.php #programs">Program Keahlian</a>
            <a href="tmpawal.php #berita">Berita</a>
            <a>Nilai</a>
            <a href="landingp.php">Logout</a>
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

        <?php
        $nama_user = $_SESSION['user']['nama'] ?? '';
        $role = $_SESSION['user']['role'] ?? '';

        if (!empty($nama_user)) {
            if ($role === 'siswa') {
                echo "<div class='welcome-message'>👋 Hai <strong>$nama_user</strong>, selamat datang di halaman nilai kamu!</div>";
            } else {
                echo "<div class='welcome-message'>👋 Selamat datang, <strong>$nama_user</strong>!</div>";
            }
        }
        ?>
    <?php if (empty($result)): ?>
                    <tr>
                        <td colspan="8">Tidak ada data yang ditemukan.</td>
        <!-- Form Pencarian -->
        <form method="GET">
            <input type="text" name="nama" placeholder="Cari berdasarkan nama" value="<?php echo htmlspecialchars($filter_nama); ?>">
            <input type="text" name="kelas" placeholder="Cari berdasarkan kelas" value="<?php echo htmlspecialchars($filter_kelas); ?>">
            <button type="submit">Cari</button>
        </form>

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