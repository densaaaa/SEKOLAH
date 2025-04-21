<?php
include 'config.php'; // Koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $mapel = $_POST['mapel'];
    $mapel_jurusan = $_POST['mapel_jurusan']; // <-- tambahkan ini

    // Perbarui query agar menyertakan mapel_jurusan
    $query = "UPDATE guru SET nama='$nama', mapel='$mapel', mapel_jurusan='$mapel_jurusan' WHERE nip='$nip'";

    if (mysqli_query($db, $query)) {
        header("Location: dataguru.php"); // Redirect kembali ke halaman utama
    } else {
        echo "Error: " . mysqli_error($db);
    }
}
?>
