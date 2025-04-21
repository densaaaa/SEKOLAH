<?php
// Include database connection
include 'config.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from form
    $nip   = mysqli_real_escape_string($db, $_POST['nip']);
    $nama  = mysqli_real_escape_string($db, $_POST['nama']);
    $mapel = mysqli_real_escape_string($db, $_POST['mapel']);
    $mapel_jurusan = mysqli_real_escape_string($db, $_POST['mapel_jurusan']);

    // Validasi: setidaknya salah satu mapel harus diisi
    if (empty($mapel) && empty($mapel_jurusan)) {
        echo "<script>alert('Isi salah satu: Mapel Umum atau Mapel Jurusan!');</script>";
        echo "<script>window.location = 'dataguru.php';</script>";
        exit();
    }

    // Cek apakah NIP sudah terdaftar
    $check_query = "SELECT * FROM guru WHERE nip = '$nip'";
    $check_result = mysqli_query($db, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // NIP sudah ada
        echo "<script>alert('NIP sudah terdaftar! Gunakan NIP yang berbeda.');</script>";
        echo "<script>window.location = 'dataguru.php';</script>";
    } else {
        // Query insert
        $query = "INSERT INTO guru (nip, nama, mapel, mapel_jurusan) 
                  VALUES ('$nip', '$nama', '$mapel', '$mapel_jurusan')";

        $result = mysqli_query($db, $query);

        if ($result) {
            echo "<script>alert('Data guru berhasil ditambahkan!');</script>";
        } else {
            echo "<script>alert('Gagal menambahkan data: " . mysqli_error($db) . "');</script>";
        }

        echo "<script>window.location = 'dataguru.php';</script>";
    }
} else {
    // Jika tidak melalui POST
    header("Location: dataguru.php");
    exit();
}
