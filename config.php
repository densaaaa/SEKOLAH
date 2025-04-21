<?php
$server = "localhost";
$user = "root";
$password = "";
$nama_database = "smk1jakarta";

$db = mysqli_connect($server, $user, $password, $nama_database, 8887);

if (!$db) {
    die("Gagal terkoneksi: ". mysqli_connect_error());
}
?>