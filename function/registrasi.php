<?php 
require 'function/connection.php';

function GenerateIDClient() {
    global $connection_database;
    $prefix = 'DAPCLIENT';
    $is_unique = false;
    while (!$is_unique) {
        $randomIDNumbers = mt_rand(10000000000, 99999999999);
        $id_client = $prefix . $randomIDNumbers;
        $result = mysqli_query($connection_database, "SELECT id_client FROM tb_client WHERE id_client = '$id_client'");
        if (!mysqli_fetch_assoc($result)) {
            $is_unique = true;
        }
    }
    return $id_client;
}

function InsertClient($data) {
    global $connection_database;
    $id_client = GenerateIDClient();
    $namalengkap = htmlspecialchars(trim(stripslashes($data['namalengkap'])));
    $jeniskelamin = htmlspecialchars(trim(stripslashes($data['jeniskelamin'])));
    $nomor = htmlspecialchars(trim($data['nomor']));
    $alamat = htmlspecialchars(trim(stripslashes($data['alamat'])));
    $email = filter_var($data["email"], FILTER_VALIDATE_EMAIL) ? $data["email"] : null;
    $tanggalmasuk = date('Y-m-d');
    $status = 'Aktif';

    // Cek apakah file foto diunggah
    if (isset($_FILES['foto']['name']) && !empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto']['name'];
        $target_directory = "images/";

        // Buat direktori jika belum ada
        if (!is_dir($target_directory)) {
            mkdir($target_directory, 0755, true);
        }

        $target_path = $target_directory . basename($foto);

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_path)) {
            // Query untuk memasukkan data ke database
            $query_registration  = "INSERT INTO tb_client (id_client, nama_client, jenis_kelamin, alamat, nomor_telepon, email, tanggal_masuk, foto_client, status_client) VALUES ('$id_client', '$namalengkap', '$jeniskelamin', '$alamat', '$nomor', '$email', '$tanggalmasuk', '$foto', '$status')";
            $registration = mysqli_query($connection_database, $query_registration);

            if ($registration) {
                return mysqli_affected_rows($connection_database);
            } else {
                echo "<script>alert('Error saat memasukkan data ke database!')</script>";
            }
        } else {
            echo "<script>alert('Error saat mengunggah foto!')</script>";
        }
    } else {
        // Jika foto tidak diunggah, gunakan foto default
        $foto = "../images/default.png";

        // Query untuk memasukkan data ke database
        $query_registration  = "INSERT INTO tb_client (id_client, nama_client, jenis_kelamin, alamat, nomor_telepon, email, tanggal_masuk, foto_client, status_client) VALUES ('$id_client', '$namalengkap', '$jeniskelamin', '$alamat', '$nomor', '$email', '$tanggalmasuk', '$foto', '$status')";
        $registration = mysqli_query($connection_database, $query_registration);

        if ($registration) {
            return mysqli_affected_rows($connection_database);
        } else {
            echo "<script>alert('Error saat memasukkan data ke database!')</script>";
        }
    }
}
?>
