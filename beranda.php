<?php
session_start();

// Sambungkan ke database
$conn = new mysqli("localhost", "root", "", "pengaduan");

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil kategori yang dipilih
$kategori_filter = isset($_GET['kategori']) ? $_GET['kategori'] : '';

// Ambil semua pengaduan dari database dengan filter kategori jika dipilih
$sql = "SELECT * FROM pengaduan";
if (!empty($kategori_filter)) {
    $sql .= " WHERE kategori = '" . $conn->real_escape_string($kategori_filter) . "'";
}
$sql .= " ORDER BY tgl_pengaduan DESC";
$result = $conn->query($sql);

// Cek apakah user adalah admin atau warga
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'warga';
$is_admin = ($role === 'admin');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Laporan Warga</title>
    <link href="https://fonts.googleapis.com/css2?family=IM+Fell+Great+Primer&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right,rgb(233, 211, 182),rgb(172, 140, 114));
            margin: 0;
            padding: 40px;
            color:rgb(0, 0, 0);
        }
        .container {
            max-width: 1400px;
            margin: auto;
            padding: 40px;
        }
        h2 {
            font-family: 'IM Fell Great Primer', sans-serif;
            font-size:  70px;
            text-align: center;
            color:rgb(85, 59, 36);
        }
        .pengaduan {
            background-image: url(brownnn.jpeg);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
        }
        .bukti-img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            border-radius: 5px;
        }
        .komentar {
            margin-top: 10px;
            padding: 10px;
            background: rgb(85, 59, 36);
            border-radius: 5px;
            color: #fff;
        }
        .btn {
            display: block;
            text-align: center;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: rgb(85, 59, 36);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            width: 200px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .btn:hover {
            background-color: rgb(37, 23, 11);
            transform: scale(1.05);
        }
        .komentar-form input, .like-btn {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: none;
            border-radius: 5px;
        }
        .komentar-form button, .like-btn {
            margin-top: 5px;
            padding: 8px 12px;
            background-color:rgb(85, 59, 36);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .komentar-form button:hover, .like-btn:hover {
            background-color:rgb(41, 35, 28);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Laporan Warga</h2>
        <p><strong>Anda login sebagai:</strong> <?php echo ucfirst($role); ?></p>
        
        <!-- Filter Kategori -->
        <form method="GET" action="">
            <label for="kategori">Filter Kategori:</label>
            <select name="kategori" id="kategori" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                <option value="Lingkungan" <?php echo ($kategori_filter == "Lingkungan") ? "selected" : ""; ?>>Lingkungan</option>
                <option value="Fasilitas Umum" <?php echo ($kategori_filter == "Fasilitas Umum") ? "selected" : ""; ?>>Fasilitas Umum</option>
                <option value="Layanan Publik" <?php echo ($kategori_filter == "Layanan Publik") ? "selected" : ""; ?>>Layanan Publik</option>
                <option value="Keamanan" <?php echo ($kategori_filter == "Keamanan") ? "selected" : ""; ?>>Keamanan</option>
            </select>
        </form>
        
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="pengaduan">
                    <p><strong>Nama:</strong> <?php echo htmlspecialchars($row['nama']); ?></p>
                    <p><strong>Kategori:</strong> <?php echo htmlspecialchars($row['kategori']); ?></p>
                    <p><strong>Deskripsi:</strong> <?php echo nl2br(htmlspecialchars($row['isi_laporan'])); ?></p>
                    <?php if (!empty($row['foto'])): ?>
                        <p><strong>Bukti:</strong></p>
                        <img src="<?php echo htmlspecialchars($row['foto']); ?>" alt="Bukti Pengaduan" class="bukti-img">
                    <?php endif; ?>

                    <!-- Form Komentar hanya untuk Admin -->
                    <?php if ($is_admin): ?>
                        <div class="komentar-form">
                            <form method="POST" action="tambah_komentar.php">
                                <input type="hidden" name="pengaduan_id" value="<?php echo $row['id_pengaduan']; ?>">
                                <input type="text" name="komentar" placeholder="Tulis komentar..." required>
                                <button type="submit">Kirim</button>
                            </form>
                        </div>
                    <?php endif; ?>

                    <!-- Tampilkan komentar dari admin -->
                    <?php
                    $pengaduan_id = $row['id_pengaduan'];
                    $komentar_query = "SELECT k.isi_komentar, k.tanggal, p.nama AS nama_admin 
                                       FROM komentar k 
                                       JOIN pengguna p ON k.admin_id = p.id 
                                       WHERE k.pengaduan_id = $pengaduan_id 
                                       ORDER BY k.tanggal ASC";
                    $komentar_result = $conn->query($komentar_query);

                    if ($komentar_result && $komentar_result->num_rows > 0): ?>
                        <div class="komentar">
                            <strong>Komentar Admin:</strong><br>
                            <?php while ($komentar = $komentar_result->fetch_assoc()): ?>
                                <p><em><?php echo htmlspecialchars($komentar['nama_admin']); ?>:</em> 
                                <?php echo nl2br(htmlspecialchars($komentar['isi_komentar'])); ?> 
                                <br><small><?php echo $komentar['tanggal']; ?></small></p>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Tidak ada laporan warga yang tersedia.</p>
        <?php endif; ?>
        
        <?php if (!$is_admin): ?>
    <a href="form_pengaduan.php" class="btn">Buat Pengaduan Baru</a>
    <a href="index.php" class="btn">Halaman Utama</a>
<?php endif; ?>

    </div>
</body>
</html>

<?php $conn->close(); ?>
