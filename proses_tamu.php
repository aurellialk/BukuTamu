<?php
session_start();

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "buku_tamu";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $pesan = htmlspecialchars($_POST['pesan']);

    $query = "INSERT INTO tb_tamu (nama, email, pesan) VALUES ('$nama','$email', '$pesan')";
    if ($conn->query($query) === TRUE) {
        echo "
        <div class='tamu-item'>
            <strong>$nama</strong> ($email)
            <em>$pesan</em>
        </div>
        ";
    }
}
?>