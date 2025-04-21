<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Registrasi Siswa
    if (isset($_POST['role']) && $_POST['role'] == 'siswa') {
        $nisn = $_POST['nisn'];
        $nama = $_POST['nama'];
        $kelas = $_POST['kelas'];
        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Query untuk tabel siswa
        $query = "INSERT INTO siswa (nisn, nama, kelas, password) 
                  VALUES ('$nisn', '$nama', '$kelas', '$hashed_password')";

        // Eksekusi query tabel siswa
        if (mysqli_query($db, $query)) {
            // Jika berhasil, tambahkan juga ke tabel nisn_to_nama
            $query_mapping = "INSERT INTO nisn_to_nama (nisn, nama) 
                             VALUES ('$nisn', '$nama')";
            
            // Eksekusi query tabel nisn_to_nama
            if (mysqli_query($db, $query_mapping)) {
                $_SESSION['message'] = "Registrasi Siswa berhasil dan data tersimpan!";
                header("Location: landingp.php");
                exit();
            } else {
                // Jika gagal menyimpan ke tabel nisn_to_nama
                $_SESSION['message'] = "Data siswa tersimpan, tetapi gagal menyimpan ke tabel referensi: " . mysqli_error($db);
                header("Location: landingp.php");
                exit();
            }
        } else {
            echo "Error: " . mysqli_error($db);
        }
    }

    // Registrasi Guru
    elseif (isset($_POST['role']) && $_POST['role'] == 'guru') {
        $nip = $_POST['nip'];
        $nama = $_POST['nama'];
        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $mapel = $_POST['mapel'] ?? null;
        $mapel_jurusan = $_POST['mapel_jurusan'] ?? null;

        // Validasi minimal satu diisi
        if (empty($mapel) && empty($mapel_jurusan)) {
            echo "Silakan isi mata pelajaran atau jurusan!";
            exit();
        }

        $query = "INSERT INTO guru (nip, nama, mapel, mapel_jurusan, password) 
                  VALUES ('$nip', '$nama', '$mapel', '$mapel_jurusan', '$hashed_password')";

        if (mysqli_query($db, $query)) {
            $_SESSION['message'] = "Registrasi Guru berhasil!";
            header("Location: landingp.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($db);
        }
    }
}
?>