<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM pengguna WHERE email='$email'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nama'];
        $_SESSION['role'] = $user['role'];

        header("Location: index.php");
        exit();
    } else {
        echo "<script>
                alert('Email atau password salah!');
                window.location.href='login.php';
              </script>";
        exit();
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

        header h2,
        header p {
            font-family: 'IM Fell Great Primer', serif;
            background: linear-gradient(to right, rgb(216, 192, 163), rgb(231, 201, 178));
            color: rgb(85, 59, 36);
            padding: 10px 0;
            text-align: center;
            width: 100%;
        }

        header h2 {
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

        form label {
            font-size: 1rem;
            color: rgb(31, 49, 66);
            margin-bottom: 5px;
            display: block;
        }

        form input {
            width: 100%;
            padding: 14px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            background-color: #f9f9f9;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        form input:focus {
            border-color: rgb(85, 59, 36);
            box-shadow: 0 0 8px rgba(85, 67, 39, 0.6);
            outline: none;
        }

        button {
            width: 100%;
            padding: 14px;
            background-color: rgb(85, 59, 36);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            margin-bottom: 10px;
        }

        button:hover {
            background-color: rgb(37, 23, 11);
            transform: scale(1.05);
        }

        a {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: rgb(85, 59, 36);
            font-size: 1rem;
            font-weight: 500;
        }

        a:hover {
            color: rgb(85, 59, 36);
        }

        .error-message {
            color: red;
            text-align: center;
            margin-top: 15px;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            form {
                padding: 25px;
            }

            button {
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <header>
        <h2>Selamat Datang di Aplikasi Pengaduan Masyarakat Kecamatan Petarukan</h2>
        <p>Melaporkan masalah layanan publik dengan mudah dan cepat</p>
    </header>
    <div class="container">
        <form action="login.php" method="POST">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>

            <div class="button-container">
                <button type="submit" class="button">Login</button>
            </div>
        </form>

        <div class="button-container">
            <button class="button" onclick="location.href='register.php'">Daftar</button>
        </div>
    </div>
</body>
</html>
