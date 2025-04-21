<?php
// Include database connection
include 'config.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from form
    $nama = mysqli_real_escape_string($db, $_POST['nama']);
    $kelas = mysqli_real_escape_string($db, $_POST['kelas']);
    $produktif = mysqli_real_escape_string($db, $_POST['produktif']);
    $ipas = mysqli_real_escape_string($db, $_POST['ipas']);
    $olga = mysqli_real_escape_string($db, $_POST['olga']);
    $b_indo = mysqli_real_escape_string($db, $_POST['b_indo']);
    $b_inggris = mysqli_real_escape_string($db, $_POST['b_inggris']);
    $matematika = mysqli_real_escape_string($db, $_POST['matematika']);
    
    // Update query
    $query = "UPDATE nilaisiswa SET 
              kelas = '$kelas', 
              produktif = '$produktif', 
              ipas = '$ipas', 
              olga = '$olga', 
              b_indo = '$b_indo', 
              b_inggris = '$b_inggris', 
              matematika = '$matematika' 
              WHERE nama = '$nama'";
    
    // Execute query
    $result = mysqli_query($db, $query);
    
    // Check if update was successful
    if ($result) {
        // Success message and redirect
        echo "<script>alert('Data nilai berhasil diperbarui!');</script>";
        echo "<script>window.location = 'datanilai.php';</script>";
    } else {
        // Error message
        echo "<script>alert('Gagal memperbarui data: " . mysqli_error($db) . "');</script>";
        echo "<script>window.location = 'datanilai.php';</script>";
    }
} else {
    // If accessed directly without POST data
    header("Location: datanilai.php");
    exit();
}
?>