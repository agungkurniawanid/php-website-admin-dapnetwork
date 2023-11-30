<?php
require '../function/connection.php';

global $connection_database;

$username = htmlspecialchars(trim($_POST["username"]));
$password = $_POST["password"];
$hak_akses = $_POST["hakakses"];

$result = mysqli_query($connection_database, "SELECT * FROM tb_pegawai WHERE username = '$username' AND hak_akses_pegawai='$hak_akses'");

$response = array();

if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_array($result);

    if (password_verify($password, $row["password"])) {
        $response['status'] = 'success';
        $response['message'] = 'Login berhasil';

        // Tambahkan catatan login ke tb_catatan_login
        $id_pegawai = $row["id_pegawai"];
        $tanggal_login = date("Y-m-d H:i:s"); // Waktu login

        // untuk diambil nama usernya 
        $nama_pegawai = $row["nama_awal"] . " " . $row["nama_akhir"];
        $response['nama_pegawai'] = $nama_pegawai;

        // untuk diambil fotonnya
        $foto_pegawai = $row["foto_pegawai"];
        $response['foto_pegawai'] = $foto_pegawai;

        // untuk diambil id nya
        $response['id_pegawai'] = $id_pegawai;

        $insert_catatan_query = "INSERT INTO tb_catatan_login (tanggal_login, id_pegawai) VALUES ('$tanggal_login', '$id_pegawai')";
        $insert_catatan_result = mysqli_query($connection_database, $insert_catatan_query);

        if (!$insert_catatan_result) {
            // Jika gagal menambahkan catatan login, tambahkan pesan ke response
            $response['status'] = 'failed';
            $response['message'] = 'Gagal menambahkan catatan login ke tb_catatan_login';
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = 'Password salah';
    }
} else {
    $response['status'] = 'failed';
    $response['message'] = "Username tidak ditemukan atau Anda tidak memiliki hak akses sebagai $hak_akses";
}

// Set header as JSON
header('Content-Type: application/json');

// Encode the response array to JSON format and echo
echo json_encode($response);
?>
