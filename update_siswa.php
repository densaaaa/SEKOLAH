<?php
// Include database connection
include 'config.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from form
    $nisn = mysqli_real_escape_string($db, $_POST['nisn']);
    $nama = mysqli_real_escape_string($db, $_POST['nama']);
    $kelas = mysqli_real_escape_string($db, $_POST['kelas']);
    
    // Update query
    $query = "UPDATE siswa SET 
              nama = '$nama', 
              kelas = '$kelas' 
              WHERE nisn = '$nisn'";
    
    // Execute query
    $result = mysqli_query($db, $query);
    
    // Check if update was successful
    if ($result) {
        // Success message and redirect
        echo "<script>alert('Data siswa berhasil diperbarui!');</script>";
        echo "<script>window.location = 'datasiswa.php';</script>";
    } else {
        // Error message
        echo "<script>alert('Gagal memperbarui data: " . mysqli_error($db) . "');</script>";
        echo "<script>window.location = 'datasiswa.php';</script>";
    }
} else {
    // If accessed directly without POST data
    header("Location: datasiswa.php");
    exit();
}
?>