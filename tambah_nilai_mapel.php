<?php
// Include database connection
include 'config.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $subject_type = $_POST['subject_type'];

    // Validate input
    if (empty($nama) || empty($kelas) || empty($subject_type)) {
        echo "<script>alert('Nama, kelas, dan tipe mata pelajaran harus diisi!'); window.location='datanilai.php';</script>";
        exit;
    }

    // Check if student exists in the database
    $check_query = "SELECT * FROM nilaisiswa WHERE nama='$nama' AND kelas='$kelas'";
    $check_result = mysqli_query($db, $check_query);

    // Get the value for the specific subject
    $subject_value = isset($_POST[$subject_type]) ? $_POST[$subject_type] : '';

    if (mysqli_num_rows($check_result) > 0) {
        // Student exists, update only the specific subject field
        $row = mysqli_fetch_assoc($check_result);

        // Update query for specific field
        $query = "UPDATE nilaisiswa SET $subject_type='$subject_value' WHERE nama='$nama' AND kelas='$kelas'";

        if (mysqli_query($db, $query)) {
            echo "<script>alert('Nilai " . ucfirst(str_replace('_', ' ', $subject_type)) . " untuk siswa $nama berhasil diperbarui!'); window.location='datanilai.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($db) . "'); window.location='datanilai.php';</script>";
        }
    } else {
        // Student doesn't exist, create a new record with only this subject filled
        $columns = "nama, kelas";
        $values = "'$nama', '$kelas'";

        // Add the specific subject
        if (!empty($subject_value)) {
            $columns .= ", $subject_type";
            $values .= ", '$subject_value'";
        }

        // Insert query
        $query = "INSERT INTO nilaisiswa ($columns) VALUES ($values)";

        if (mysqli_query($db, $query)) {
            echo "<script>alert('Nilai " . ucfirst(str_replace('_', ' ', $subject_type)) . " untuk siswa $nama berhasil ditambahkan!'); window.location='datanilai.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($db) . "'); window.location='datanilai.php';</script>";
        }
    }
} else {
    // If accessed directly without form submission, redirect to datanilai.php
    header("Location: datanilai.php");
    exit;
}
