<?php
include 'config.php';

$pesan = ''; // variabel untuk menyimpan pesan sukses atau error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO pengguna (nama, email, password) VALUES ('$nama', '$email', '$hashed_password')";
    if ($conn->query($sql) === TRUE) {
        $pesan = "Registrasi berhasil! <a href='login.php'>Login</a>";
    } else {
        $pesan = "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=IM+Fell+Great+Primer&display=swap" rel="stylesheet">
    <style>
        * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body, html {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(to right, rgb(233, 211, 182), rgb(212, 181, 156));
    color: rgb(109, 124, 139);
    height: 100vh;
}

header h1,
header p {
    font-family: 'IM Fell Great Primer', serif;
    background: linear-gradient(to right, rgb(216, 192, 163), rgb(231, 201, 178));
    color: rgb(85, 59, 36);
    padding: 20px 0;
    text-align: center;
    width: 100%;
}


header h1 {
    font-size: 3.5em;
}

header p {
    font-size: 1.2em;
}

.container {
    background-image: url(brownnn.jpeg);
    padding: 60px;
    border-radius: 30px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    
    width: 100%;
    max-width: 700px; 
    margin: 30px auto; 
}
        .pesan {
            width: 100%;
            max-width: 700px;    /* biar sama lebar maksimal container */
            margin: 20px auto;   /* tengah horizontal & jarak atas bawah */
            padding: 15px;
            background-color: #fff7e6;
            border: 1px solid #d6a96e;
            border-radius: 6px;
            text-align: center;
            color: #5e3e24;
            font-weight: bold;
            box-sizing: border-box;
        }

        label {
            font-size: 1em;
            color: #333;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1em;
            color: #333;
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: rgb(85, 59, 36);
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: rgb(70, 48, 29);
            transform: scale(1.05);
        }

        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: rgb(92, 65, 49);
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        @media (max-width: 500px) {
            .container {
                width: 100%;
                padding: 15px;
            }

            h1 {
                font-size: 1.6em;
            }
        }
    </style>
</head>
<body>
<header>
        <h1>Registrasi Pengguna</h1>
    </header>
<?php if (!empty($pesan)) : ?>
            <div class="pesan"><?php echo $pesan; ?></div>
        <?php endif; ?>
    <div class="container">
        <form action="register.php" method="POST">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Daftar</button>
        </form>
        <a href="login.php">Sudah punya akun? Login</a>
    </div>
</body>
</html>
