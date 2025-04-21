<?php
include 'config.php'; // Menggunakan file koneksi yang sudah ada

// Ambil total siswa
$querySiswa = $db->query("SELECT COUNT(*) AS total_siswa FROM siswa");
$dataSiswa = $querySiswa->fetch_assoc();
$totalSiswa = $dataSiswa['total_siswa'];

// Ambil total guru
$queryGuru = $db->query("SELECT COUNT(*) AS total_guru FROM guru");
$dataGuru = $queryGuru->fetch_assoc();
$totalGuru = $dataGuru['total_guru'];

// Hitung total kunjungan hari ini
$totalKunjungan = $totalSiswa + $totalGuru + 200;
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard SMK 1 Jakarta</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/dash.css?v=9">
    <link href="https://cdn.jsdelivr.net/npm/chart.js">
</head>

<body>
    <div class="dashboard">
        <div class="sidebar">
            <div class="sidebar-logo">
                <img src="img/smkn1-jakarta.png" alt="SMK 1 Jakarta Logo">
                <h2>SMK 1 Jakarta</h2>
            </div>
            <ul class="sidebar-menu">
                <li><a href="#dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="dataguru.php"><i class="fas fa-chalkboard-teacher"></i> Manajemen Guru</a></li>
                <li><a href="datasiswa.php"><i class="fas fa-users"></i> Manajemen Siswa</a></li>
                <li><a href="datanilai.php"><i class="fas fa-book"></i> Manajemen Nilai</a></li>
                <li><a href="tmpadmin.php"><i class="fas fa-sign-in-alt"></i> Login Website</a></li>
                <li><a href="landingp.php"><i class="fas fa-sign-out-alt"></i> Logout Dashboard</a></li>
            </ul>
        </div>
        <div class="main-content">
            <div class="header">
                <h1>Dashboard</h1>
                <div class="user-info">
                    <i class="fas fa-user-circle"></i> Admin
                </div>
            </div>

            <div class="card-grid">
                <div class="card">
                    <h3>Total Guru</h3>
                    <h2><?php echo number_format($totalGuru); ?></h2>
                </div>
                <div class="card">
                    <h3>Total Siswa</h3>
                    <h2><?php echo number_format($totalSiswa); ?></h2>
                </div>
                <div class="card">
                    <h3>Kunjungan Hari Ini</h3>
                    <h2><?php echo number_format($totalKunjungan); ?></h2>
                </div>
            </div>

            <div class="chart-container" id="statistik">
                <div class="card">
                    <h3>Statistik Kunjungan Website</h3>
                    <canvas id="websiteVisitsChart"></canvas>
                </div>
                <div class="card">
                    <h3>Distribusi Pengunjung</h3>
                    <canvas id="visitorDistributionChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/dash.js?=v2"></script>
</body>

</html>
