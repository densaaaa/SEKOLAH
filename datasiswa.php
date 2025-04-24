<?php
ob_start(); // Start output buffering
include 'config.php';

// POST processing logic - moved to the beginning of the file
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get values from form
    $nisn = mysqli_real_escape_string($db, $_POST['nisn']);
    $nama = mysqli_real_escape_string($db, $_POST['nama']);
    $kelas = mysqli_real_escape_string($db, $_POST['kelas']);

    // Get original name before update (needed if name is changed)
    $getOriginalNameQuery = "SELECT nama FROM siswa WHERE nisn = '$nisn'";
    $originalNameResult = mysqli_query($db, $getOriginalNameQuery);
    $originalNameRow = mysqli_fetch_assoc($originalNameResult);
    $originalName = $originalNameRow['nama'];

    // Update siswa table
    $updateSiswaQuery = "UPDATE siswa SET nama = '$nama', kelas = '$kelas' WHERE nisn = '$nisn'";
    $resultSiswa = mysqli_query($db, $updateSiswaQuery);

    // Update nisn_to_nama table
    $updateMappingQuery = "UPDATE nisn_to_nama SET nama = '$nama' WHERE nisn = '$nisn'";
    $resultMapping = mysqli_query($db, $updateMappingQuery);

    // If name was changed, update nilaisiswa table to reflect the new name
    if ($originalName != $nama) {
        $updateNilaiQuery = "UPDATE nilaisiswa SET nama = '$nama' WHERE nama = '$originalName'";
        mysqli_query($db, $updateNilaiQuery);
    }

    // Redirect back to student management page
    header("Location: datasiswa.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Siswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/datasiswa.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="dashboard">
        <div class="sidebar">
            <div class="sidebar-logo">
                <img src="img/smkn1-jakarta.png" alt="SMK 1 Jakarta Logo">
                <h2>SMK 1 Jakarta</h2>
            </div>
            <ul class="sidebar-menu">
                <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="dataguru.php"><i class="fas fa-chalkboard-teacher"></i> Manajemen Guru</a></li>
                <li><a href="datasiswa.php"><i class="fas fa-users"></i> Manajemen Siswa</a></li>
                <li><a href="datanilai.php"><i class="fas fa-book"></i> Manajemen Nilai</a></li>
                <li><a href="tmpawal.php"><i class="fas fa-sign-in-alt"></i> Login Website</a></li>
                <li><a href="landingp.php"><i class="fas fa-sign-out-alt"></i> Logout Dashboard</a></li>
            </ul>
        </div>
        <div class="main-content">
            <h1>Manajemen Siswa</h1>
            <button onclick="tambahSiswa()">
                <i class="fas fa-plus"></i> Tambah Siswa
            </button>

            <!-- Form Pencarian -->
            <form method="GET" action="datasiswa.php">
                <input type="text" name="search_nisn" placeholder="Cari NISN">
                <input type="text" name="search_nama" placeholder="Cari Nama">
                <input type="text" name="search_kelas" placeholder="Cari Kelas">
                <button type="submit">Cari</button>
            </form>

            <table border="1" cellpadding="10" cellspacing="0">
                <tr>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
                <?php
                // Logika Hapus Data
                if (isset($_GET['hapus_nisn'])) {
                    $nisnToDelete = mysqli_real_escape_string($db, $_GET['hapus_nisn']);

                    // First get the student's name based on NISN
                    $getNameQuery = "SELECT nama FROM siswa WHERE nisn = '$nisnToDelete'";
                    $nameResult = mysqli_query($db, $getNameQuery);

                    if ($nameRow = mysqli_fetch_assoc($nameResult)) {
                        $studentName = $nameRow['nama'];

                        // Delete records from nilaisiswa table based on the student's name
                        $deleteNilaiQuery = "DELETE FROM nilaisiswa WHERE nama = '$studentName'";
                        mysqli_query($db, $deleteNilaiQuery);

                        // Delete record from nisn_to_nama table
                        $deleteNisnToNamaQuery = "DELETE FROM nisn_to_nama WHERE nisn = '$nisnToDelete'";
                        mysqli_query($db, $deleteNisnToNamaQuery);

                        // Finally delete the student record
                        $deleteStudentQuery = "DELETE FROM siswa WHERE nisn = '$nisnToDelete'";
                        mysqli_query($db, $deleteStudentQuery);
                        
                        // Redirect to refresh the page
                        header("Location: datasiswa.php");
                        exit();
                    }
                }

                // Query pencarian
                $query = "SELECT * FROM siswa WHERE 1";
                if (!empty($_GET['search_nisn'])) {
                    $query .= " AND nisn LIKE '%" . $_GET['search_nisn'] . "%'";
                }
                if (!empty($_GET['search_nama'])) {
                    $query .= " AND nama LIKE '%" . $_GET['search_nama'] . "%'";
                }
                if (!empty($_GET['search_kelas'])) {
                    $query .= " AND kelas LIKE '%" . $_GET['search_kelas'] . "%'";
                }
                $result = mysqli_query($db, $query);

                // Tampilkan data
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
            <td>{$row['nisn']}</td>
            <td>{$row['nama']}</td>
            <td>{$row['kelas']}</td>
            <td>
                <button onclick=\"editSiswa('{$row['nisn']}', '{$row['nama']}', '{$row['kelas']}')\">Edit</button>
                <a href='?hapus_nisn={$row['nisn']}' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
            </td>
        </tr>";
                }
                ?>
            </table>
        </div>
    </div>

    <!-- Form Edit Pop-up -->
    <div id="editPopup" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px #000;">
        <h2>Edit Siswa</h2>
        <form action="datasiswa.php" method="post">
            <input type="hidden" name="nisn" id="editNisn">
            <label>Nama:</label>
            <input type="text" name="nama" id="editNama" required><br>
            <label>Kelas:</label>
            <input type="text" name="kelas" id="editKelas" required><br>
            <button type="submit">Simpan</button>
            <button type="button" onclick="closePopup()">Batal</button>
        </form>
    </div>

    <div id="tambahPopup" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px #000;">
        <h2>Tambah Siswa</h2>
        <form action="tambah_siswa.php" method="post">
            <label>NISN:</label>
            <input type="text" name="nisn" required><br>
            <label>Nama:</label>
            <input type="text" name="nama" required><br>
            <label>Kelas:</label>
            <input type="text" name="kelas" required><br>
            <button type="submit">Simpan</button>
            <button type="button" onclick="closePopup('tambahPopup')">Batal</button>
        </form>
    </div>

    <script>
        function editSiswa(nisn, nama, kelas) {
            document.getElementById('editNisn').value = nisn;
            document.getElementById('editNama').value = nama;
            document.getElementById('editKelas').value = kelas;
            document.getElementById('editPopup').style.display = 'block';
        }

        function closePopup(popupId) {
            // If no popupId is provided, close the edit popup
            if (!popupId) {
                document.getElementById('editPopup').style.display = 'none';
            } else {
                // Otherwise close the specified popup
                document.getElementById(popupId).style.display = 'none';
            }
        }

        function tambahSiswa() {
            document.getElementById('tambahPopup').style.display = 'block';
        }
    </script>
</body>

</html>
<?php
ob_end_flush(); // End output buffering
?>