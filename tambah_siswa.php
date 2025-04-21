<?php
// Include database connection
include 'config.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];

    // Validate input (basic validation)
    if (empty($nisn) || empty($nama) || empty($kelas)) {
        echo "<script>alert('Semua field harus diisi!'); window.location='datasiswa.php';</script>";
        exit;
    }

    // Check if NISN already exists
    $check_query = "SELECT * FROM siswa WHERE nisn = '$nisn'";
    $check_result = mysqli_query($db, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('NISN sudah terdaftar!'); window.location='datasiswa.php';</script>";
        exit;
    }

    // Insert data into database
    $query = "INSERT INTO siswa (nisn, nama, kelas) VALUES ('$nisn', '$nama', '$kelas')";

    if (mysqli_query($db, $query)) {
        echo "<script>alert('Data siswa berhasil ditambahkan!'); window.location='datasiswa.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($db) . "'); window.location='datasiswa.php';</script>";
    }
} else {
    // If accessed directly without form submission, redirect to datasiswa.php
    header("Location: datasiswa.php");
    exit;
}
