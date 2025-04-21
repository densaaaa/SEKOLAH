<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = isset($_POST['role']) ? $_POST['role'] : '';
    $nisn = isset($_POST['nisn']) ? $_POST['nisn'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Pastikan role yang diterima valid
    if ($role !== "siswa") {
        echo json_encode(["status" => "error", "message" => "Role tidak valid!"]);
        exit();
    }

    // Gunakan prepared statement untuk mencegah SQL Injection
    $query = "SELECT * FROM siswa WHERE nisn = ?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "s", $nisn);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['role'] = $role;
            $_SESSION['nisn'] = $row['nisn']; // Simpan data sesi jika perlu

            echo json_encode(["status" => "success", "redirect" => "nilaisiswa.php"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Password salah!"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "NISN tidak ditemukan!"]);
    }

    mysqli_stmt_close($stmt);
    exit();
}
?>
