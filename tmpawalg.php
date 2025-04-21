<?php
session_start(); // Memulai session untuk mengambil data session

include 'config.php'; // FIXED: harus include koneksi DB

if (isset($_POST['login_guru'])) {
    $nip = $_POST['nip'];
    $password = $_POST['password'];

    $query = mysqli_query($db, "SELECT * FROM guru WHERE nip = '$nip'");
    $data = mysqli_fetch_assoc($query);

    if ($data && password_verify($password, $data['password'])) {
        $_SESSION['role'] = 'guru';
        $_SESSION['nip'] = $data['nip'];
        $_SESSION['mapel'] = $data['mapel'];
        $_SESSION['mapel_jurusan'] = $data['mapel_jurusan']; // FIXED: penamaan
        header("Location: nilaiguru.php");
        exit();
    } else {
        $_SESSION['message'] = "Login gagal! NIP atau password salah.";
        header("Location: tmpawalg.php");
        exit();
    }
}

// Tampilkan notifikasi jika ada
if (isset($_SESSION['message'])) {
    echo "<p>{$_SESSION['message']}</p>";
    unset($_SESSION['message']);
}

?>




<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMKN 1 Jakarta - Sekolah Unggulan Untuk Masa Depan Cemerlang</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/tmp.css?=v6">
</head>

<body>
    <!-- Navbar -->
    <nav>
        <div class="logname" id="nav">
            <img src="img/smkn1-jakarta.png" alt="Logo SMKN 1 Jakarta">
            <h1>SMKN 1 JAKARTA</h1>
        </div>
        <div class="nav-menu">
            <a href="#beranda">Beranda</a>
            <a href="#profil">Profil</a>
            <a href="#programs">Program Keahlian</a>
            <a href="#berita">Berita</a>
            <a href="nilaiguru.php">Nilai</a>
            <a href="landingp.php">Logout</a>
        </div>
        <div class="hamburger">
            <i class="fas fa-bars"></i>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="beranda">
        <div class="hero-decoration">
            <div class="circle circle-1"></div>
            <div class="circle circle-2"></div>
            <div class="circle circle-3"></div>
        </div>

        <div class="hero-content">
            <h2>Mewujudkan Generasi Unggul, Kreatif, dan Berakhlak Mulia</h2>
            <p>SMKN 1 Jakarta menyediakan pendidikan berkualitas untuk mempersiapkan siswa menghadapi tantangan dunia kerja dengan kompetensi yang dibutuhkan industri.</p>
        </div>

        <div class="hero-image">
            <div class="slider">
                <div class="slide active">
                    <img src="img/skl.jpg" alt="Siswa SMKN 1 Jakarta">
                </div>
                <div class="slide">
                    <img src="img/skl1.jpg" alt="Fasilitas SMKN 1 Jakarta">
                </div>
                <div class="slide">
                    <img src="img/skl2.jpg" alt="Kegiatan SMKN 1 Jakarta">
                </div>
            </div>

            <div class="slider-dots">
                <span class="dot active" data-slide="0"></span>
                <span class="dot" data-slide="1"></span>
                <span class="dot" data-slide="2"></span>
            </div>

            <!-- Tombol navigasi -->
            <button class="carousel-btn left">&#10094;</button>
            <button class="carousel-btn right">&#10095;</button>
        </div>
    </section>

    <!-- Features -->
    <section class="features" id="profil">
        <h2 class="section-title">Mengapa Memilih SMKN 1 Jakarta?</h2>
        <p class="section-subtitle">Kami menawarkan pendidikan terbaik dengan berbagai keunggulan untuk mempersiapkan siswa meraih masa depan cemerlang.</p>

        <div class="feature-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3 class="feature-title">Tenaga Pengajar Profesional</h3>
                <p class="feature-text">Didukung oleh guru-guru berpengalaman dan tersertifikasi di bidangnya.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-laptop-code"></i>
                </div>
                <h3 class="feature-title">Kurikulum Industri</h3>
                <p class="feature-text">Kurikulum yang dirancang sesuai kebutuhan dunia kerja dan industri terkini.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-building"></i>
                </div>
                <h3 class="feature-title">Kerjasama Industri</h3>
                <p class="feature-text">Bermitra dengan berbagai perusahaan untuk program magang dan rekrutmen lulusan.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-medal"></i>
                </div>
                <h3 class="feature-title">Prestasi Nasional</h3>
                <p class="feature-text">Berbagai penghargaan tingkat kota dan nasional telah diraih oleh siswa kami.</p>
            </div>
        </div>
    </section>


    <!-- Program Keahlian Section -->
    <section class="programs" id="programs">
        <div class="section-header">
            <h2 class="section-title">Program Keahlian Unggulan</h2>
            <p class="section-subtitle">SMKN 1 Jakarta menawarkan berbagai program keahlian yang dirancang untuk mempersiapkan siswa dengan keterampilan dan pengetahuan yang dibutuhkan di dunia kerja.</p>
        </div>

        <div class="programs-grid">
            <div class="program-card">
                <img src="img/tkp.jpeg" alt="Teknik Konstruksi dan Perumahan" class="program-img">
                <div class="program-content">
                    <h3 class="program-title">Teknik Konstruksi dan Perumahan</h3>
                    <p class="program-desc">Mempelajari keterampilan dalam perencanaan, konstruksi bangunan, dan manajemen proyek perumahan.</p>
                    <a href="https://smkn1jakarta.sch.id/tkp/" class="program-link">Selengkapnya</a>
                </div>
            </div>

            <div class="program-card">
                <img src="img/dgm.jpeg" alt="Desain Grafis dan Multimedia" class="program-img">
                <div class="program-content">
                    <h3 class="program-title">Desain Grafis dan Multimedia</h3>
                    <p class="program-desc">Fokus pada desain visual, animasi, dan multimedia untuk berbagai kebutuhan industri kreatif.</p>
                    <a href="https://smkn1jakarta.sch.id/tpgm/" class="program-link">Selengkapnya</a>
                </div>
            </div>

            <div class="program-card">
                <img src="img/dpib.png" alt="Desain Permodelan dan Informasi Bangunan" class="program-img">
                <div class="program-content">
                    <h3 class="program-title">Desain Permodelan dan Informasi Bangunan</h3>
                    <p class="program-desc">Mempelajari teknologi CAD dan BIM untuk merancang serta mendokumentasikan proyek bangunan.</p>
                    <a href="https://smkn1jakarta.sch.id/dpib/" class="program-link">Selengkapnya</a>
                </div>
            </div>

            <div class="program-card">
                <img src="img/titl.jpeg" alt="Teknik Instalasi Tenaga Listrik" class="program-img">
                <div class="program-content">
                    <h3 class="program-title">Teknik Instalasi Tenaga Listrik</h3>
                    <p class="program-desc">Menyiapkan siswa dalam instalasi listrik rumah tangga, industri, dan sistem tenaga listrik.</p>
                    <a href="https://smkn1jakarta.sch.id/teknik-instalasi-tenaga-listrik/" class="program-link">Selengkapnya</a>
                </div>
            </div>

            <div class="program-card">
                <img src="https://smk-maarifkudus.sch.id/wp-content/uploads/2024/02/DSC_2939-copy-1024x684.jpg" alt="Teknik Pengelasan" class="program-img">
                <div class="program-content">
                    <h3 class="program-title">Teknik Pemesinan</h3>
                    <p class="program-desc">Mempelajari teknik pemesinan menggunakan berbagai jenis mesin industri seperti bubut, frais, dan CNC.</p>
                    <a href="https://smkn1jakarta.sch.id/teknik-pemesinan/" class="program-link">Selengkapnya</a>
                </div>
            </div>

            <div class="program-card">
                <img src="img/tkr.jpg" alt="Teknik Kendaraan Ringan" class="program-img">
                <div class="program-content">
                    <h3 class="program-title">Teknik Kendaraan Ringan</h3>
                    <p class="program-desc">Mendalami sistem otomotif, perbaikan mesin, dan teknologi kendaraan modern.</p>
                    <a href="https://smkn1jakarta.sch.id/teknik-kendaraan-ringan/" class="program-link">Selengkapnya</a>
                </div>
            </div>

            <div class="program-card">
                <img src="img/rpl.jpg" alt="Rekayasa Perangkat Lunak" class="program-img">
                <div class="program-content">
                    <h3 class="program-title">Rekayasa Perangkat Lunak</h3>
                    <p class="program-desc">Belajar pengembangan software, coding, dan implementasi sistem berbasis teknologi.</p>
                    <a href="https://smkn1jakarta.sch.id/rpl/" class="program-link">Selengkapnya</a>
                </div>
            </div>

            <div class="program-card">
                <img src="img/tkj.jpg" alt="Teknik Komputer dan Jaringan" class="program-img">
                <div class="program-content">
                    <h3 class="program-title">Teknik Komputer dan Jaringan</h3>
                    <p class="program-desc">Mempelajari instalasi, konfigurasi, dan pengelolaan jaringan komputer serta keamanan sistem.</p>
                    <a href="https://smkn1jakarta.sch.id/teknik-komputer-dan-jaringan/" class="program-link">Selengkapnya</a>
                </div>
            </div>

            <div class="program-card">
                <img src="img/sija.jpg" alt="Sistem Informasi Jaringan dan Aplikasi" class="program-img">
                <div class="program-content">
                    <h3 class="program-title">Sistem Informasi Jaringan dan Aplikasi</h3>
                    <p class="program-desc">Menyiapkan siswa dalam pengelolaan sistem informasi berbasis jaringan dan pengembangan aplikasi.</p>
                    <a href="https://smkn1jakarta.sch.id/sija/" class="program-link">Selengkapnya</a>
                </div>
            </div>

            <div class="program-card">
                <img src="img/dkv.jpg" alt="Desain Komunikasi Visual" class="program-img">
                <div class="program-content">
                    <h3 class="program-title">Desain Komunikasi Visual</h3>
                    <p class="program-desc">Belajar desain branding, ilustrasi, dan komunikasi visual untuk berbagai media.</p>
                    <a href="https://smkn1jakarta.sch.id/dkv/" class="program-link">Selengkapnya</a>
                </div>
            </div>
        </div>
    </section>


    <!-- Berita Section -->
    <section class="news" id="berita">
        <div class="section-header">
            <h2 class="section-title">Berita & Kegiatan Terkini</h2>
            <p class="section-subtitle">Temukan informasi terbaru mengenai kegiatan, prestasi, dan pengumuman penting dari SMKN 1 Jakarta.</p>
        </div>

        <div class="news-container">
            <div class="news-grid">
                <div class="news-card">
                    <div class="news-img">
                        <img src="https://smkn1jakarta.sch.id/wp-content/uploads/2024/08/Achmad-Shafa-kelas-X-TKJ-534x464.png" alt="Juara Lomba Kompetensi Siswa">
                        <div class="news-date">
                            <span class="day">15</span>
                            <span class="month">Agt</span>
                        </div>
                    </div>
                    <div class="news-content">
                        <div class="news-category">Prestasi</div>
                        <h3 class="news-title">SISWA/I SMKN 1 JAKARTA MARAIH PRESTASI PADA TURNAMEN “INDONESIA YOUTH GAMES” BULAN AGUSTUS 2024</h3>
                        <p class="news-excerpt">Indonesia Youth Games merupakan sebuah ajang olahraga nasional yang diadakan dengan tujuan untuk mendukung dan mengembangkan potensi atlet muda di Indonesia.</p>
                        <a href="https://smkn1jakarta.sch.id/siswa-i-smkn-1-jakarta-maraih-prestasi-pada-turnamen-indonesia-youth-games-bulan-agustus-2024/" class="news-link">Baca Selengkapnya</a>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-img">
                        <img src="https://smkn1jakarta.sch.id/wp-content/uploads/2024/10/WhatsApp-Image-2024-10-01-at-14.16.04-534x464.jpg" alt="Kerjasama dengan Industri">
                        <div class="news-date">
                            <span class="day">28</span>
                            <span class="month">Sep</span>
                        </div>
                    </div>
                    <div class="news-content">
                        <div class="news-category">Prestasi</div>
                        <h3 class="news-title">SMKN 1 Jakarta Menjadi Juara Umum Pramuka Penegak Kwarcab</h3>
                        <p class="news-excerpt">SMK Negeri 1 Jakarta turut berpartisipasi dalam acara Lomba Kreativitas Penegak berlangsung pada tanggal 28 September 2024 yang dimulai pukul 08.00 WIB bertempat di Kantor Pemerintahan Kota Administrasi Jakarta Pusat.</p>
                        <a href="https://smkn1jakarta.sch.id/smkn-1-juara-umum-lkp-tingkat-kota-administrasi-jakarta-pusat/" class="news-link">Baca Selengkapnya</a>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-img">
                        <img src="https://smkn1jakarta.sch.id/wp-content/uploads/2024/08/WhatsApp-Image-2024-08-26-at-10.44.02-534x464.jpeg" alt="Workshop Digital Marketing">
                        <div class="news-date">
                            <span class="day">24</span>
                            <span class="month">Agt</span>
                        </div>
                    </div>
                    <div class="news-content">
                        <div class="news-category">Prestasi</div>
                        <h3 class="news-title">SISWA SMKN 1 Jakarta Berprestasi Pada LKS Ke 32 Di Lampung</h3>
                        <p class="news-excerpt">Lomba Keterampilan Siswa sebuah kompetisi yang diadakan setahun sekali dengan bertujuan untuk mengevaluasi dan meningkatkan keterampilan teknis serta kejuruan siswa.</p>
                        <a href="https://smkn1jakarta.sch.id/siswa-smkn-1-jakarta-berprestasi-pada-lks-ke-32-di-lampung/#google_vignette" class="news-link">Baca Selengkapnya</a>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-img">
                        <img src="https://smkn1jakarta.sch.id/wp-content/uploads/2024/08/MANDIRI-2024-1200x630.jpg" alt="Pembukaan PPDB">
                        <div class="news-date">
                            <span class="day">5</span>
                            <span class="month">Feb</span>
                        </div>
                    </div>
                    <div class="news-content">
                        <div class="news-category">Pengumuman</div>
                        <h3 class="news-title">Data Siswa Lolos Mandiri 2024 SMKN 1 Jakarta</h3>
                        <p class="news-excerpt">Seleksi Mandiri adalah metode penerimaan mahasiswa baru yang dilaksanakan oleh perguruan tinggi negeri secara independen.</p>
                        <a href="https://smkn1jakarta.sch.id/data-siswa-smkn-1-jakarta-lolos-seleksi-mandiri-ptn-2024/" class="news-link">Baca Selengkapnya</a>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-img">
                        <img src="https://smkn1jakarta.sch.id/wp-content/uploads/2016/11/IMG-20141030-00082-1024x630.jpg" alt="Workshop Digital Marketing">
                        <div class="news-date">
                            <span class="day">29</span>
                            <span class="month">Okt</span>
                        </div>
                    </div>
                    <div class="news-content">
                        <div class="news-category">Prestasi</div>
                        <h3 class="news-title">SMKN 1 Jakarta Juara LKS IT Software Dan Pemesinan</h3>
                        <p class="news-excerpt">SMK N 1 Jakarta dapat Juara 1 dan 2 pada LKS IT Software dan Permesinan Juara 3 di Tingkat Wilayah Jakarta Pusat .</p>
                        <a href="https://smkn1jakarta.sch.id/smk-n-1-juara-lks-it-software-dan-permesinan-wilayah-jakarta-pusat/#google_vignette" class="news-link">Baca Selengkapnya</a>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-img">
                        <img src="https://smkn1jakarta.sch.id/wp-content/uploads/2019/08/pramuka_ke58_tahun_2019-1040x630.jpeg" alt="Pembukaan PPDB">
                        <div class="news-date">
                            <span class="day">5</span>
                            <span class="month">Feb</span>
                        </div>
                    </div>
                    <div class="news-content">
                        <div class="news-category">kegiatan</div>
                        <h3 class="news-title">Upacara Hari Pramuka Ke 58 Tahun 2019</h3>
                        <p class="news-excerpt">Tema Hari Pramuka Tahun 2019 : “Peringatan 58 Tahun Gerakan Pramuka Bersama Seluruh Komponen Bangsa Siap Sedia Membangun Keutuhan NKRI”.</p>
                        <a href="https://smkn1jakarta.sch.id/upacara-hari-pramuka-ke-58-tahun-2019/" class="news-link">Baca Selengkapnya</a>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-img">
                        <img src="https://smkn1jakarta.sch.id/wp-content/uploads/2016/11/IMG-20140507-00065-1024x630.jpg" alt="Pembukaan PPDB">
                        <div class="news-date">
                            <span class="day">7</span>
                            <span class="month">Mei</span>
                        </div>
                    </div>
                    <div class="news-content">
                        <div class="news-category">Kerjasama</div>
                        <h3 class="news-title">Workshop Autodesk SMKN 1 Jakarta</h3>
                        <p class="news-excerpt">AutoDesk mengadakan workshop di SMK Negeri 1 Jakarta, hari ini tanggal 7 – 8 Mei 2014, dengan 130 peserta yang terdaftar dan di sponsori oleh PT. Tekno Logika Utama.</p>
                        <a href="https://smkn1jakarta.sch.id/workshop-autodesk-smk-n-1-jakarta/" class="news-link">Baca Selengkapnya</a>
                    </div>
                </div>

                <div class="news-sidebar">
                    <h3 class="sidebar-title">Berita Terbaru</h3>
                    <div class="sidebar-news-item">
                        <img src="https://smkn1jakarta.sch.id/wp-content/uploads/2024/08/Achmad-Shafa-kelas-X-TKJ-534x464.png" alt="Sidebar News" class="sidebar-news-thumbnail">
                        <div class="sidebar-news-content">
                            <a href="https://smkn1jakarta.sch.id/siswa-i-smkn-1-jakarta-maraih-prestasi-pada-turnamen-indonesia-youth-games-bulan-agustus-2024/" class="sidebar-news-title">Meraih Prestasi Pad..</a>
                            <span class="sidebar-news-date">15 Agt 2025</span>
                        </div>
                    </div>
                    <div class="sidebar-news-item">
                        <img src="https://smkn1jakarta.sch.id/wp-content/uploads/2024/10/WhatsApp-Image-2024-10-01-at-14.16.04-534x464.jpg" alt="Sidebar News" class="sidebar-news-thumbnail">
                        <div class="sidebar-news-content">
                            <a href="https://smkn1jakarta.sch.id/smkn-1-juara-umum-lkp-tingkat-kota-administrasi-jakarta-pusat/" class="sidebar-news-title">SMKN 1 Jakarta Jua..</a>
                            <span class="sidebar-news-date">28 Sep 2025</span>
                        </div>
                    </div>
                    <div class="sidebar-news-item">
                        <img src="https://smkn1jakarta.sch.id/wp-content/uploads/2016/11/IMG-20140507-00065-1024x630.jpg" alt="Sidebar News" class="sidebar-news-thumbnail">
                        <div class="sidebar-news-content">
                            <a href="https://smkn1jakarta.sch.id/workshop-autodesk-smk-n-1-jakarta/" class="sidebar-news-title">Workshop Autodes..</a>
                            <span class="sidebar-news-date">7 Mei 2025</span>
                        </div>
                    </div>
                    <div class="sidebar-news-item">
                        <img src="https://smkn1jakarta.sch.id/wp-content/uploads/2019/08/pramuka_ke58_tahun_2019-1040x630.jpeg" alt="Sidebar News" class="sidebar-news-thumbnail">
                        <div class="sidebar-news-content">
                            <a href="https://smkn1jakarta.sch.id/upacara-hari-pramuka-ke-58-tahun-2019/" class="sidebar-news-title">Upacara Hari Pram..</a>
                            <span class="sidebar-news-date">5 Feb 2025</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Statistik Section -->
    <section class="stats">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">98%</div>
                <div class="stat-label">Tingkat Keterserapan Lulusan</div>
            </div>

            <div class="stat-item">
                <div class="stat-number">25+</div>
                <div class="stat-label">Mitra Industri</div>
            </div>

            <div class="stat-item">
                <div class="stat-number">50+</div>
                <div class="stat-label">Prestasi Nasional</div>
            </div>

            <div class="stat-item">
                <div class="stat-number">2000+</div>
                <div class="stat-label">Alumni Sukses</div>
            </div>
        </div>
    </section>

    <!-- Partner -->

    <div class="container1">
        <h1 class="title1">Industrial Partners</h1>
        <div class="partner-grid1">
            <div class="partner-card">
                <img src="https://pindad.com/uploads/images/article/full/LOGO_PINDAD_resize.png" alt="Partner 1">
                <p class="partner-name">PT Pindad</p>
            </div>
            <div class="partner-card">
                <img src="https://upload.wikimedia.org/wikipedia/id/a/a4/Dirgantara_Indonesia_logo.jpeg" alt="Partner 2">
                <p class="partner-name">PT Dirgantara Indonesia</p>
            </div>
            <div class="partner-card">
                <img src="https://www.mmaglobal.com/files/styles/member_logo_large/public/logos/mayora_logo.svg_.png?itok=Skteut7L" alt="Partner 3">
                <p class="partner-name">PT Mayora Indah Tbk</p>
            </div>
            <div class="partner-card">
                <img src="https://tabloidmatahati.com/wp-content/uploads/2023/05/GUDANG-1024x585.jpg" alt="Partner 4">
                <p class="partner-name">PT Gudang Garam</p>
            </div>
            <div class="partner-card">
                <img src="https://bluepacservices.co.id/wp-content/uploads/2022/10/1.png" alt="Partner 1">
                <p class="partner-name">PAMA PERSADA</p>
            </div>
            <div class="partner-card">
                <img src="https://i.pinimg.com/736x/c6/75/63/c675637185072c5a2dc1726bff892046.jpg" alt="Partner 2">
                <p class="partner-name">PT PERTAMINA</p>
            </div>
            <div class="partner-card">
                <img src="https://keretaapikita.com/wp-content/uploads/2020/09/Logo-Baru-PT-KAI.jpg" alt="Partner 3">
                <p class="partner-name">PT KAI</p>
            </div>
            <div class="partner-card">
                <img src="https://vstecsindo.net/wp-content/uploads/2020/01/nvidia.jpg" alt="Partner 4">
                <p class="partner-name">NVIDIA</p>
            </div>
        </div>
    </div>

    <div id="nilai-popup-container">
        <div class="nilai-login-box">
            <span class="nilai-popup-close">&times;</span>
            <h2>Login</h2>
            <div class="nilai-auth-types">
                <button class="nilai-type-selector selected" data-type="siswa">Siswa</button>
                <button class="nilai-type-selector" data-type="guru" name="role">Guru</button>
            </div>
            <form class="nilai-form-input" id="nilai-siswa-form" action="loginilai.php" method="POST">
                <input type="hidden" name="role" value="siswa">
                <input type="text" name="nisn" id="nisn" placeholder="nisn" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">LOGIN</button>
            </form>
            <form class="nilai-form-input" id="nilai-guru-form" action="loginilai.php" method="POST" style="display: none;">
                <input type="hidden" name="role" value="guru">
                <input type="text" name="nip" id="nip" placeholder="nip" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">LOGIN</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-info">
                <h3>SMKN 1 Jakarta</h3>
                <p>Mencetak generasi muda yang kompeten, kreatif, dan siap bersaing di era global dengan landasan karakter dan akhlak mulia.</p>
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Jl. Budi Utomo No.7, Ps. Baru, Jakarta Pusat 10710</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <span>(021) 3865002</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <span>info@smkn1jakarta.sch.id</span>
                    </div>
                </div>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <div class="quick-links">
                <h3>Tautan Cepat</h3>
                <ul>
                    <li><a href="#beranda">Beranda</a></li>
                    <li><a href="#profil">Profil Sekolah</a></li>
                    <li><a href="#programs">Program Keahlian</a></li>
                    <li><a href="#berita">Berita & Kegiatan</a></li>
                </ul>
            </div>

            <div class="quick-links">
                <h3>Informasi</h3>
                <ul>
                    <li><a href="https://smkn1jakarta.sch.id/identitas-sekolah/" target="_blank">Identitas Sekolah</a></li>
                    <li><a href="https://smkn1jakarta.sch.id/prestasi/" target="_blank">Prestasi</a></li>
                    <li><a href="https://smkn1jakarta.sch.id/fasilitas/" target="_blank">Fasilitas</a></li>
                    <li><a href="https://smkn1jakarta.sch.id/kemitraan/" target="_blank">Kemitraan</a></li>
                </ul>
            </div>
        </div>

        <div class="copyright">
            &copy; 2025 SMKN 1 Jakarta. Hak Cipta Dilindungi.
        </div>
    </footer>

    <script src="js/tmp.js?=v10"></script>
</body>

</html>