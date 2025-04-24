<?php
include 'config.php'; // Koneksi ke database

// Menghapus data guru jika ada permintaan delete
if (isset($_GET['hapus'])) {
    $nip = $_GET['hapus'];
    $query = "DELETE FROM guru WHERE nip='$nip'";
    mysqli_query($db, $query);
    header("Location: dataguru.php");
    exit();
}

// Mencari data guru berdasarkan pencarian
$searchNip = isset($_GET['searchNip']) ? $_GET['searchNip'] : '';
$searchNama = isset($_GET['searchNama']) ? $_GET['searchNama'] : '';
$searchMapel = isset($_GET['searchMapel']) ? $_GET['searchMapel'] : '';

$query = "SELECT * FROM guru WHERE nip LIKE '%$searchNip%' AND nama LIKE '%$searchNama%' AND mapel LIKE '%$searchMapel%'";
$result = mysqli_query($db, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ManajemeN Guru</title>
    <link rel="stylesheet" href="css/dataguru.css?=v18">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
            <h1>Manajemen Guru</h1>
            <button class="action-button" onclick="showTambahForm()">
                <i class="fas fa-plus"></i> Tambah Guru
            </button>
            <form method="GET">
                <input type="text" name="searchNip" placeholder="Cari NIP" value="<?php echo $searchNip; ?>">
                <input type="text" name="searchNama" placeholder="Cari Nama" value="<?php echo $searchNama; ?>">
                <input type="text" name="searchMapel" placeholder="Cari Mapel" value="<?php echo $searchMapel; ?>">
                <button type="submit">Cari</button>
            </form>
            <table border="1">
                <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Mapel Umum</th>
                    <th>Mapel Jurusan</th>
                    <th>Aksi</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['nip']; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['mapel']; ?></td>
                        <td><?php echo $row['mapel_jurusan']; ?></td>
                        <td>
                        <button onclick="editGuru('<?php echo $row['nip']; ?>', '<?php echo $row['nama']; ?>', '<?php echo $row['mapel']; ?>', '<?php echo htmlspecialchars($row['mapel_jurusan'], ENT_QUOTES); ?>')">Edit</button>

                            <a href="?hapus=<?php echo $row['nip']; ?>" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>

    <!-- Pop-up Form Edit -->
    <div id="editForm">
        <form action="update_guru.php" method="POST">
            <h2>Edit Guru</h2>
            <input type="hidden" name="nip" id="editNip">
            <label>Nama:</label>
            <input type="text" name="nama" id="editNama" required>
            <label>Mata Pelajaran:</label>
            <input type="text" name="mapel" id="editMapel" >
            <label>Mapel Jurusan:</label>
            <input type="text" name="mapel_jurusan" id="editMapelJurusan" >

            <button type="submit">Simpan</button>
            <button type="button" onclick="$('#editForm').hide();">Batal</button>
        </form>
    </div>

    <div id="tambahPopup" class="popup-form">
        <h2>Tambah Guru Baru</h2>
        <form action="tambah_guru.php" method="post">
            <label for="tambahNip">NIP:</label>
            <input type="text" name="nip" id="tambahNip" required>
            <label for="tambahNama">Nama:</label>
            <input type="text" name="nama" id="tambahNama" required>
            <label for="tambahMapel">Mapel:</label>
            <input type="text" name="mapel" id="tambahMapel">
            <label for="tambahMapelJurusan">Mapel Jurusan:</label>
            <input type="text" name="mapel_jurusan" id="tambahMapelJurusan">
            <button type="submit">Simpan</button>
            <button type="button" onclick="closeTambahPopup()">Batal</button>
        </form>
    </div>


    <script>
        function editGuru(nip, nama, mapel, mapelJurusan) {
            $('#editNip').val(nip);
            $('#editNama').val(nama);
            $('#editMapel').val(mapel);
            $('#editMapelJurusan').val(mapelJurusan);
            $('#editForm').show();
        }


        function showTambahForm() {
            document.getElementById('tambahPopup').style.display = 'block';
        }

        function closeTambahPopup() {
            document.getElementById('tambahPopup').style.display = 'none';
        }
    </script>
</body>

</html>