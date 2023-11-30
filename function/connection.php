<?php 
$host = "ftp.tifa.myhost.id";
$user = "tifamyho_dapnet";
$password = "@JTIpolije2023";
$database = "tifamyho_dapnet";

$connection_database = mysqli_connect($host, $user, $password, $database);

// Memeriksa koneksi
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}
?>
