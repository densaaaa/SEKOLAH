<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST['role'] ?? '';
    $user = $_POST['user'] ?? '';
    $nisn = $_POST['nisn'] ?? '';
    $nip = $_POST['nip'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validasi input berdasarkan role
    if ($role === "admin" && (empty($user) || empty($password))) {
        echo "Harap isi username dan password untuk admin!";
        exit();
    } elseif (($role === "siswa" && (empty($nisn) || empty($password))) ||
              ($role === "guru" && (empty($nip) || empty($password)))) {
        echo "Harap isi NISN/NIP dan password!";
        exit();
    }




    // Query berdasarkan role
    if ($role === "admin") {
        $query = "SELECT * FROM admin WHERE user = ?";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, 's', $user);
    } elseif ($role === "siswa") {
        $query = "SELECT * FROM siswa WHERE nisn = ?";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, 's', $nisn);
    } elseif ($role === "guru") {
        $query = "SELECT * FROM guru WHERE nip = ?";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, 's', $nip);
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $row;
            $_SESSION['role'] = $role;

            if ($role === "guru") {
                $_SESSION['mapel'] = $row['mapel'];
                $_SESSION['mapel_jurusan'] = $row['jurusan']; // ✅ ganti dari mapel_jurusan jadi jurusan
                header("Location: tmpawalg.php");
            } elseif ($role === "admin") {
                header("Location: dashboard.php");
            } elseif ($role === "siswa") {
                header("Location: tmpawal.php");
            }

            exit();
        } else {
            echo "Password salah!";
        }
    } else {
        echo "Username atau NISN/NIP tidak ditemukan!";
    }
}
?>
