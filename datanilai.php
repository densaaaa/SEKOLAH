<?php
include 'config.php'; // Koneksi ke database

// Menghapus data nilai jika ada permintaan delete
if (isset($_GET['hapus'])) {
    $nama = $_GET['hapus'];
    $query = "DELETE FROM nilaisiswa WHERE nama='$nama'";
    mysqli_query($db, $query);
    header("Location: datanilai.php");
    exit();
}

// Mencari data nilai berdasarkan pencarian
$searchnama = isset($_GET['searchnama']) ? $_GET['searchnama'] : '';
$searchkelas = isset($_GET['searchkelas']) ? $_GET['searchkelas'] : '';
$searchmapel_jurusan = isset($_GET['searchmapel_jurusan']) ? $_GET['searchmapel_jurusan'] : '';

$query = "SELECT * FROM nilaisiswa WHERE nama LIKE '%$searchnama%' AND kelas LIKE '%$searchkelas%' AND produktif LIKE '%$searchmapel_jurusan%'";
$result = mysqli_query($db, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Nilai Siswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/datanilai.css?=v16">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Add jQuery -->
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
                <li><a href="datanilai.php" class="active"><i class="fas fa-book"></i> Manajemen Nilai</a></li>
                <li><a href="tmpawal.php"><i class="fas fa-sign-in-alt"></i> Login Website</a></li>
                <li><a href="landingp.php"><i class="fas fa-sign-out-alt"></i> Logout Dashboard</a></li>
            </ul>
        </div>
        <div class="main-content">
            <h1>Manajemen Nilai</h1>

            <!-- Dropdown untuk memilih mata pelajaran untuk input nilai -->
            <div style="margin-bottom: 15px;">
                <label for="mapelSelector"><strong>Pilih Mata Pelajaran:</strong></label>
                <select id="mapelSelector" onchange="showTambahButton()" style="padding: 8px; margin-right: 10px; border-radius: 4px; border: 1px solid #ddd;">
                    <option value=""> Pilih Mata Pelajaran </option>
                    <option value="ipas">Ipas</option>
                    <option value="olga">Olga</option>
                    <option value="b_indo">Bahasa Indonesia</option>
                    <option value="b_inggris">Bahasa Inggris</option>
                    <option value="matematika">Matematika</option>
                    <option value="produktif">Mata Pelajaran Jurusan</option>
                </select>

                <button id="tambahNilaiBtn" onclick="tambahNilai()" style="display: none; padding: 8px 15px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">
                    <i class="fas fa-plus"></i> Tambah Nilai
                </button>
            </div>

            <form method="GET" action="" class="search-box">
                <input type="text" name="searchnama" placeholder="Cari Nama" value="<?php echo $searchnama; ?>">
                <input type="text" name="searchkelas" placeholder="Cari Kelas" value="<?php echo $searchkelas; ?>">
                <input type="text" name="searchmapel_jurusan" placeholder="Cari Mata elajaran" value="<?php echo $searchmapel_jurusan; ?>">
                <button type="submit">Cari</button>
            </form>

            <table class="nilai-table" id="nilaiTable" border="1">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Mapel Jurusan</th>
                        <th>Ipas</th>
                        <th>Olga</th>
                        <th>B Indonesia</th>
                        <th>B Inggris</th>
                        <th>Matematika</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['nama']; ?></td>
                            <td><?php echo $row['kelas']; ?></td>
                            <td><?php echo $row['produktif']; ?></td>
                            <td><?php echo $row['ipas']; ?></td>
                            <td><?php echo $row['olga']; ?></td>
                            <td><?php echo $row['b_indo']; ?></td>
                            <td><?php echo $row['b_inggris']; ?></td>
                            <td><?php echo $row['matematika']; ?></td>
                            <td>
                                <button onclick="editNilai('<?php echo $row['nama']; ?>', '<?php echo $row['kelas']; ?>', '<?php echo $row['produktif']; ?>', '<?php echo $row['ipas']; ?>', '<?php echo $row['olga']; ?>', '<?php echo $row['b_indo']; ?>', '<?php echo $row['b_inggris']; ?>', '<?php echo $row['matematika']; ?>')">Edit</button>
                                <a href="?hapus=<?php echo $row['nama']; ?>" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Form Edit Nilai Pop-up -->
    <div id="editForm">
    <form action="update_nilai.php" method="POST">
        <h2>Edit Nilai Siswa</h2>

        <div class="form-group">
            <label for="editnama">Nama:</label>
            <input type="text" name="nama" id="editnama" required readonly>
        </div>

        <div class="form-group">
            <label for="editkelas">Kelas:</label>
            <input type="text" name="kelas" id="editkelas" required>
        </div>

        <div class="form-group">
            <label for="editproduktif">Mata Pelajaran Jurusan:</label>
            <input type="text" name="produktif" id="editproduktif" required>
        </div>

        <div class="form-group">
            <label for="editipas">Ipas:</label>
            <input type="text" name="ipas" id="editipas" required>
        </div>

        <div class="form-group">
            <label for="editolga">Olga:</label>
            <input type="text" name="olga" id="editolga" required>
        </div>

        <div class="form-group">
            <label for="editbindo">B Indonesia:</label>
            <input type="text" name="b_indo" id="editbindo" required>
        </div>

        <div class="form-group">
            <label for="editbing">B Inggris:</label>
            <input type="text" name="b_inggris" id="editbing" required>
        </div>

        <div class="form-group">
            <label for="editmatematika">Matematika:</label>
            <input type="text" name="matematika" id="editmatematika" required>
        </div>

        <div class="form-actions">
            <button type="submit">Simpan</button>
            <button type="button" onclick="hideForm('editForm')">Batal</button>
        </div>
    </form>
</div>


    <!-- Form Tambah Nilai Pop-up (Subject-specific) -->
    <div id="tambahForm" style="display: none;">
    <form action="tambah_nilai_mapel.php" method="POST">
        <h2 id="tambahFormTitle">Tambah Nilai</h2>

        <input type="hidden" name="subject_type" id="subject_type">

        <div class="form-group">
            <label for="tambahnama">Nama Siswa:</label>
            <input type="text" name="nama" id="tambahnama" required>
        </div>

        <div class="form-group">
            <label for="tambahkelas">Kelas:</label>
            <input type="text" name="kelas" id="tambahkelas" required>
        </div>

        <!-- Mata pelajaran jurusan -->
        <div class="form-group" id="produktif_field" style="display: none;">
            <label for="tambahproduktif">Nilai Mata Pelajaran Jurusan:</label>
            <input type="text" name="produktif" id="tambahproduktif">
        </div>

        <div class="form-group" id="ipas_field" style="display: none;">
            <label for="tambahipas">Nilai Ipas:</label>
            <input type="text" name="ipas" id="tambahipas">
        </div>

        <div class="form-group" id="olga_field" style="display: none;">
            <label for="tambaholga">Nilai Olga:</label>
            <input type="text" name="olga" id="tambaholga">
        </div>

        <div class="form-group" id="b_indo_field" style="display: none;">
            <label for="tambahbindo">Nilai B Indonesia:</label>
            <input type="text" name="b_indo" id="tambahbindo">
        </div>

        <div class="form-group" id="b_inggris_field" style="display: none;">
            <label for="tambahbing">Nilai B Inggris:</label>
            <input type="text" name="b_inggris" id="tambahbing">
        </div>

        <div class="form-group" id="matematika_field" style="display: none;">
            <label for="tambahmatematika">Nilai Matematika:</label>
            <input type="text" name="matematika" id="tambahmatematika">
        </div>

        <div class="form-actions">
            <button type="submit">Simpan</button>
            <button type="button" onclick="hideForm('tambahForm')">Batal</button>
        </div>
    </form>
</div>


    <script>
        // Show Add button when subject is selected
        function showTambahButton() {
            var selector = document.getElementById('mapelSelector');
            var button = document.getElementById('tambahNilaiBtn');

            if (selector.value !== "") {
                button.style.display = 'inline-block';
            } else {
                button.style.display = 'none';
            }
        }

        // Fungsi untuk menampilkan form edit
        function editNilai(nama, kelas, produktif, ipas, olga, b_indo, b_inggris, matematika) {
            document.getElementById('editnama').value = nama;
            document.getElementById('editkelas').value = kelas;
            document.getElementById('editproduktif').value = produktif;
            document.getElementById('editipas').value = ipas;
            document.getElementById('editolga').value = olga;
            document.getElementById('editbindo').value = b_indo;
            document.getElementById('editbing').value = b_inggris;
            document.getElementById('editmatematika').value = matematika;
            document.getElementById('editForm').style.display = 'block';
        }

        // Fungsi untuk menampilkan form tambah nilai berdasarkan mapel yang dipilih
        function tambahNilai() {
            var selector = document.getElementById('mapelSelector');
            var selectedSubject = selector.value;

            if (selectedSubject === "") {
                alert("Silakan pilih mata pelajaran terlebih dahulu");
                return;
            }

            // Sembunyikan semua field mata pelajaran
            document.getElementById('produktif_field').style.display = 'none';
            document.getElementById('ipas_field').style.display = 'none';
            document.getElementById('olga_field').style.display = 'none';
            document.getElementById('b_indo_field').style.display = 'none';
            document.getElementById('b_inggris_field').style.display = 'none';
            document.getElementById('matematika_field').style.display = 'none';

            // Tampilkan field yang sesuai dengan mata pelajaran yang dipilih
            document.getElementById(selectedSubject + '_field').style.display = 'block';

            // Set judul form
            var subjectTitles = {
                'ipas': 'Tambah Nilai Ipas',
                'olga': 'Tambah Nilai Olga',
                'b_indo': 'Tambah Nilai Bahasa Indonesia',
                'b_inggris': 'Tambah Nilai Bahasa Inggris',
                'matematika': 'Tambah Nilai Matematika',
                'produktif': 'Tambah Nilai Mata Pelajaran Jurusan'
            };

            document.getElementById('tambahFormTitle').innerText = subjectTitles[selectedSubject];
            document.getElementById('subject_type').value = selectedSubject;

            // Tampilkan form
            document.getElementById('tambahForm').style.display = 'block';
        }

        // Fungsi untuk menyembunyikan form
        function hideForm(formId) {
            document.getElementById(formId).style.display = 'none';
        }

        // Script untuk fitur pencarian real-time
        document.addEventListener('DOMContentLoaded', function() {
            if (document.getElementById('searchInput')) {
                document.getElementById('searchInput').addEventListener('keyup', function() {
                    let searchText = this.value.toLowerCase();
                    let table = document.getElementById('nilaiTable');
                    let rows = table.getElementsByTagName('tr');

                    for (let i = 1; i < rows.length; i++) {
                        let found = false;
                        let cells = rows[i].getElementsByTagName('td');

                        // Periksa semua kolom
                        for (let j = 0; j < cells.length; j++) {
                            let cellText = cells[j].textContent || cells[j].innerText;
                            if (cellText.toLowerCase().indexOf(searchText) > -1) {
                                found = true;
                                break;
                            }
                        }

                        rows[i].style.display = found ? "" : "none";
                    }
                });
            }
        });
    </script>
</body>

</html>