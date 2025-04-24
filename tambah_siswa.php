<?php
include 'config.php';

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get values from form
    $nisn = mysqli_real_escape_string($db, $_POST['nisn']);
    $nama = mysqli_real_escape_string($db, $_POST['nama']);
    $kelas = mysqli_real_escape_string($db, $_POST['kelas']);
    
    // Insert into siswa table
    $insertSiswaQuery = "INSERT INTO siswa (nisn, nama, kelas) VALUES ('$nisn', '$nama', '$kelas')";
    $resultSiswa = mysqli_query($db, $insertSiswaQuery);
    
    // Insert into nisn_to_nama table
    $insertMappingQuery = "INSERT INTO nisn_to_nama (nisn, nama) VALUES ('$nisn', '$nama')";
    $resultMapping = mysqli_query($db, $insertMappingQuery);
    
    // Check if both insertions were successful
    if ($resultSiswa && $resultMapping) {
        // Success - redirect back to student management page
        header("Location: datasiswa.php");
        exit();
    } else {
        // Error occurred
        echo "Error: " . mysqli_error($db);
    }
} else {
    // If accessed directly without form submission, redirect to the student management page
    header("Location: datasiswa.php");
    exit();
}
?>