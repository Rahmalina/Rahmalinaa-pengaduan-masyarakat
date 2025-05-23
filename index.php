<?php
session_start();

// // Jika pengguna sudah login
 if (isset($_SESSION['role'])) {
     if ($_SESSION['role'] === 'admin') {
         header("Location: beranda.php");
         exit();
     } 
 }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pengaduan Masyarakat</title>
    <link href="https://fonts.googleapis.com/css2?family=IM+Fell+Great+Primer&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Resetting some default styles */
* {
    margin: 0;
    padding: 0;
}
body {
    font-family: 'Poppins', serif;
    background-color: white;
    color: #333;
    background-size: cover; /* Membuat gambar mengisi seluruh halaman */
    background-position: center center; /* Memastikan gambar berada di tengah */
    background-attachment: fixed; /* Membuat gambar latar belakang tetap ketika di-scroll */
}

/* Header Styles */
header {
    font-family: 'IM Fell Great Primer', serif;
    background: linear-gradient(to right,rgb(216, 192, 163),rgb(231, 201, 178));
    color:rgb(85, 59, 36);
    padding: 20px 0;
    text-align: center;
}

header h1 {
    font-size: 3.0em;
}

header p {
    font-size: 1.2em;
}

/* Container Style */
.container {
    background-image: url(brownnn.jpeg);
    padding: 30px;
    border-radius: 10px; /* Membuat sudut kontainer melengkung */
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Bayangan lembut di sekeliling kontainer */
    max-width: 1300px;
    margin: 20px auto
}

.container2 {
    background : linear-gradient (to right,rgb(233, 211, 182),rgb(212, 181, 156));
    padding: 30px;
    border-radius: 10px; /* Membuat sudut kontainer melengkung */
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Bayangan lembut di sekeliling kontainer */
    max-width: 800px;
    margin: 20px auto;
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Menambahkan transisi untuk efek hover */
    color:rgb(85, 59, 36);
}

/* Efek saat hover di container */
.container2:hover {
    transform: translateY(-10px); /* Efek mengangkat kontainer ke atas */
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2); /* Menambah bayangan lebih tebal saat hover */
}

/* Title (h2) Styling */
.container h2 {
    font-size: 1.8em;
    color: #333;
    margin-bottom: 20px;
}

/* Paragraph Styling */
.container p {
    font-size: 1.2em;
    color: #555;
    margin-bottom: 10px;
}

.feature {
    background: white;
    padding: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    flex: 1;
    margin: 10px;
    border-radius: 5px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

/* Button Container Styling */
.button-container {
    margin-top: 30px;
    display:grid;
}

.button {
    background-color:rgb(85, 59, 36);
    color: white;
    padding: 12px 30px;
    font-size: 1.1em;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
    
}

.button:hover {
    background-color:rgb(43, 30, 19);
    transform: scale(1.05);
}

/* Info Box Styling */
.info-box {
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    margin-top: 30px;
}

.info-box h2 {
    font-size: 1.8em;
    margin-bottom: 15px;
}

.info-box p {
    font-size: 1.2em;
}

/* Footer Styling */
footer {
    background-color:rgb(138, 105, 78);
    color: white;
    text-align: center;
    padding: 10px;
    position: fixed;
    width: 100%;
    bottom: 0;
}
    </style>
</head>
<body>

<header>
    <h1>Aplikasi Pengaduan Masyarakat Kecamatan Petarukan</h1>
    <p>Melaporkan masalah layanan publik dengan mudah dan cepat</p>
</header>

<div class="container">
    <h2>Selamat datang di aplikasi pengaduan layanan masyarakat Kecamatan Petarukan!</h2>
    <p>Apakah Anda memiliki masalah atau keluhan terkait layanan publik? Gunakan aplikasi ini untuk melaporkan masalah Anda.</p>

    <div class="button-container">
        <button class="button" onclick="location.href='form_pengaduan.php'">Ajukan Pengaduan</button>
    </div>
    <div class="button-container">
        <button class="button" onclick="location.href='beranda.php'">Laporan Warga</button>
    </div>

    <div class="container2">
        <h2>Fitur Aplikasi:</h2>
        <p>- Mudah mengajukan pengaduan secara online.</p>
        <p>- Pantau status pengaduan Anda secara real-time.</p>
        <p>- Dapatkan respons cepat dari instansi terkait.</p>
    </div>
</div>

<footer>
    <p>&copy; 2025 Aplikasi Pengaduan Masyarakat. All rights reserved.</p>
</footer>

</body>
</html>
