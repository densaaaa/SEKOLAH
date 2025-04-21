<?php
session_start(); // Memulai session untuk mengambil data session

// Memeriksa apakah ada pesan notifikasi
if (isset($_SESSION['message'])) {
    echo "<p>{$_SESSION['message']}</p>"; // Menampilkan pesan
    unset($_SESSION['message']); // Menghapus pesan setelah ditampilkan
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <title>Performance Ultrabook - Landing Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/land.css?v=6">

</head>

<body>
    <nav>
        <div class="logname">
            <img src="img/smkn1-jakarta.png" alt="Logo SMKN 1 Jakarta">
            <h1>SMKN 1 JAKARTA</h1>
        </div>
        <div class="nav-menu">
            <a href="#" id="admin-link">Admin</a>
        </div>
        <div class="hamburger">
            <i class="fas fa-bars"></i>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-decoration">
            <div class="circle circle-1"></div>
            <div class="circle circle-2"></div>
            <div class="circle circle-3"></div>
        </div>

        <div class="hero-content">
            <h2>SELAMAT DATANG</h2>
            <p>Selamat datang di situs resmi SMKN 1 Jakarta. Silahkan login untuk mengakses situs digital sekolah.</p>

            <div class="cta-buttons">
                <a href="tmpawal1.php" class="btn border-orange" id="guest-login-btn">Guest</a>
                <a href="#" class="btn login-popup" id="umum-login-btn">Login Siswa/Guru</a>
            </div>
        </div>

        <div class="hero-image">
            <img src="img/undraw_book-lover_cmz5.png" alt="Ultrabook">
        </div>
    </section>

    <div class="login-admin" id="login-popup-admin">
        <div class="login-container">
            <span class="close-popup" id="close-popup-admin">&times;</span>
            <h2>Login Admin</h2>
            <form class="login-form" id="login-form-admin" action="login.php" method="POST">
                <input type="hidden" name="role" value="admin">
                <input type="text" name="user" placeholder="user admin" required>
                <input type="password" name="password" placeholder="password" required>
                <button type="submit">Login Admin</button>
            </form>
        </div>
    </div>

    <div class="login-admin" id="login-popup-umum">
        <div class="login-container">
            <span class="close-popup" id="close-popup-umum">&times;</span>
            <h2>Login Warga Sekolah</h2>

            <div class="login-options">
                <button type="button" id="btn-siswa" class="login-type-btn active">Siswa</button>
                <button type="button" id="btn-guru" class="login-type-btn">Guru</button>
            </div>

            <form class="login-form" id="login-form-umum-siswa" action="login.php" method="POST">
                <input type="hidden" name="role" value="siswa">
                <input type="text" name="nisn" placeholder="nisn" required>
                <input type="password" name="password" placeholder="password" required>
                <button type="submit">Login Siswa</button>
            </form>


            <form class="login-form" id="login-form-umum-guru" style="display: none;" action="login.php" method="POST">
                <input type="hidden" name="role" value="guru">
                <input type="text" placeholder="nip" name="nip" required>
                <input type="password" placeholder="password" id="password-guru" name="password" required>
                <button type="submit">Login Guru</button>
            </form>

            <p class="register-link">Belum punya akun? <a href="#" id="show-register-form">Register</a></p>

        </div>
    </div>

    <div class="login-admin" id="register-popup" style="display: none;">
        <div class="login-container">
            <span class="close-popup" id="close-register-popup">&times;</span>
            <h2>Register</h2>

            <div class="register-options">
                <button type="button" id="btn-reg-siswa" class="register-type-btn active">Siswa</button>
                <button type="button" id="btn-reg-guru" class="register-type-btn">Guru</button>
            </div>

            <!-- Form Register Siswa -->
            <form class="register-form" id="register-form-siswa" action="register.php" method="POST">
                <input type="hidden" name="role" value="siswa">
                <input type="text" placeholder="nisn" name="nisn" id="reg-nisn" required>
                <input type="text" placeholder="nama siswa" name="nama" cid="reg-nama-siswa" required>
                <input type="text" placeholder="Kelas" name="kelas" id="reg-kelas" required>
                <input type="password" placeholder="password" name="password" id="reg-password-siswa" required>
                <button type="submit">Register Siswa</button>
            </form>

            <!-- Form Register Guru (Tanpa dropdown, auto-klasifikasi) -->
            <form class="register-form" id="register-form-guru" style="display: none;" action="register.php" method="POST">
                <input type="hidden" name="role" value="guru">
                <input type="text" placeholder="nip" name="nip" id="reg-nip" required>
                <input type="text" placeholder="nama guru" name="nama" id="reg-nama-guru" required>

                <!-- Form input -->
                <input type="text" id="mapel-input" placeholder="Masukkan mata pelajaran (contoh: RPL / B Indo)" required>

                <!-- Dua hidden input tetap -->
                <input type="hidden" id="mapel-hidden" name="mapel" value="">
                <input type="hidden" id="mapeljurusan-hidden" name="mapel_jurusan" value="">


                <input type="password" placeholder="Password" name="password" id="reg-password-guru" required>
                <button type="submit">Register Guru</button>
            </form>




            <p class="register-link">Sudah punya akun? <a href="#" id="show-login-form">Login</a></p>

        </div>
    </div>

    </div>


    <script src="js/land.js?=v3"></script>
</body>

</html>