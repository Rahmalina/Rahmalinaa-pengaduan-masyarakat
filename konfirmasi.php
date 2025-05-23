<?php
session_start();

// Cek apakah data pengaduan tersedia di session
if (!isset($_SESSION['pengaduan'])) {
    header("Location: form_pengaduan.php"); // Ganti dengan form kamu
    exit();
}

$pengaduan = $_SESSION['pengaduan'];
unset($_SESSION['pengaduan']); // Supaya gak bisa diakses lagi saat refresh
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pengaduan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right,rgb(233, 211, 182),rgb(212, 181, 156));
            text-align: center;
            display: flex;
            padding: 50px;
        }
        .content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-top: 30px; 
        }
        .container {
            background-image: url(brownnn.jpeg);
            padding: 70px;
            border-radius: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
             background-color:rgb(85, 59, 36);
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn:hover {
            background-color:rgb(37, 23, 11);
            transform: scale(1.05)
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Pengaduan Berhasil Dikirim!</h2>
        <p><strong>Nama:</strong> <?= htmlspecialchars($pengaduan['nama']) ?></p>
        <p><strong>Kategori:</strong> <?= htmlspecialchars($pengaduan['kategori']) ?></p>
        <p><strong>Deskripsi:</strong> <?= nl2br(htmlspecialchars($pengaduan['deskripsi'])) ?></p>
        <?php if (!empty($pengaduan['bukti'])): ?>
            <p><strong>Bukti:</strong> <a href="<?= htmlspecialchars($pengaduan['bukti']) ?>" target="_blank">Lihat Bukti</a></p>
        <?php endif; ?>
        <a href="beranda.php" class="btn">Kembali ke Beranda</a>
    </div>
</body>
</html>
