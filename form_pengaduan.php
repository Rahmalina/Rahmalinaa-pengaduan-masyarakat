<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "pengaduan");

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
$bukti = '';

// Upload bukti jika ada
if (isset($_FILES['bukti']) && $_FILES['bukti']['error'] == 0) {
    $target_dir = "uploads/";
    $file_name = time() . "_" . basename($_FILES["bukti"]["name"]);
    $target_file = $target_dir . $file_name;

    if (move_uploaded_file($_FILES["bukti"]["tmp_name"], $target_file)) {
        $bukti = $target_file;
    }
}

// gunakan $deskripsi dan $bukti yang sudah ada
$sql = "INSERT INTO pengaduan (nama, kategori, isi_laporan, foto, tgl_pengaduan) VALUES (?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nama, $kategori, $deskripsi, $bukti);

    if ($stmt->execute()) {
        // Simpan data ke session untuk konfirmasi
        $_SESSION['pengaduan'] = [
            'nama' => $nama,
            'kategori' => $kategori,
            'deskripsi' => $deskripsi,
            'bukti' => $bukti
        ];

        header("Location: konfirmasi.php");
        exit();
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pengaduan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right,rgb(233, 211, 182),rgb(212, 181, 156));
            height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        h2 {
            font-family: 'Georgia', serif;
            color: rgb(85, 59, 36);
            position: absolute;
            top: 30px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            width: 100%;
            margin: 0;
            padding: 10px 0;
            font-size: 40px;
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
        label {
            font-weight: bold;
        }
        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color:rgb(85, 59, 36);
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        button:hover {
            background-color:rgb(37, 23, 11);
            transform: scale(1.05)
        }
        .image-container {
            max-width: 40%;
        }
        .image-container img {
            width: 100%;
            max-height: 90vh;
            object-fit: contain;
        }
    </style>
</head>
<body>
    <h2>Formulir Pengaduan</h2>
    <div class="content">
        <div class="container">
        <form action="" method="POST" enctype="multipart/form-data">
                <label for="nama">Nama Pelapor</label>
                <input type="text" id="nama" name="nama" required>
                
                <label for="kategori">Kategori Pengaduan</label>
                <select id="kategori" name="kategori" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Lingkungan">Lingkungan</option>
                    <option value="Fasilitas Umum">Fasilitas Umum</option>
                    <option value="Layanan Publik">Layanan Publik</option>
                    <option value="Keamanan">Keamanan</option>
                </select>
                
                <label for="deskripsi">Deskripsi Pengaduan</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" required></textarea>
                
                <label for="bukti">Unggah Bukti (Opsional)</label>
                <input type="file" id="bukti" name="bukti" accept="image/*, .pdf">
            <div class="button-container">
                <button type="submit" class="button">Ajukan Pengaduan</button>
                </div>

    </form>
        </div>
        <div class="image-container">
            <img src="orang.png" alt="Illustrasi">
        </div>
    </div>
</body>
</html>
