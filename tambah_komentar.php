<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pengaduan_id = $_POST['pengaduan_id'];
    $komentar = $_POST['komentar'];
    $admin_id = $_SESSION['user_id'];

    // Simpan komentar ke database
    $sql = "INSERT INTO komentar (pengaduan_id, admin_id, isi_komentar, tanggal) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $pengaduan_id, $admin_id, $komentar);

    if ($stmt->execute()) {
        header("Location: beranda.php");
    } else {
        echo "Gagal menambahkan komentar: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
