<?php 
session_start();

// koneksi database (ini ditambahkan)
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";

$dbname = "buku_tamu";
// buat koneksi
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

// cek koneksi
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// login cek (ini pakai data hardcoded, bukan dari database)
// $validUsername = "admin";
// $validPassword = "1234";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password'";
    $fetch = $conn->query($query);

    if ($fetch->num_rows > 0) {
        $_SESSION['username'] = $username;

        $log = "$username berhasil login pada " . date("Y-m-d H:i:s") . "\n";
        file_put_contents("log_login.txt", $log, FILE_APPEND);
        
        header("Location: buku_tamu.php");
        exit();
    } else {
        $errorMessage = "Username atau password salah. Silakan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Buku Tamu</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F4E1C1; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: #FFF5E1; 
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 350px;
        }

        .profile-icon {
            width: 80px; 
            height: 80px;
            border-radius: 50%;
            background-color: #E5A8A8; 
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 15px auto; 
        }

        .profile-icon img {
            width: 50px; 
            height: 50px;
        }

        h2 {
            color: #8B5E3C; 
            font-weight: bold;
            margin-bottom: 20px;
        }

        input {
            width: 90%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #8B5E3C;
            border-radius: 8px;
            background: #FFF8E7; 
            font-size: 14px;
            text-align: center;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #8B5E3C; 
            border: none;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 8px;
        }

        button:hover {
            background: #6F4E37; 
        }

        .error {
            color: red;
            margin-bottom: 10px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="profile-icon">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="User Icon">
        </div>

        <h2>User Login</h2>
        
        <?php if (isset($errorMessage)) { echo "<p class='error'>$errorMessage</p>"; } ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
