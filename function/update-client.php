<?php 
require 'connection.php';

function UpdateClient($data){
    global $connection_database;
    $id = $data["id_client"];
    $nama = htmlspecialchars($data["nama_client"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $gender = htmlspecialchars($data["gender"]);
    $nomor = htmlspecialchars($data["nomor_telepon"]);
    $email = htmlspecialchars($data["email"]);
    $tanggal = htmlspecialchars($data["tanggal_masuk"]);

    // Cek apakah file foto diunggah
    if (!empty($_FILES["foto"]["name"])) {
        $foto_lama = htmlspecialchars($data["foto_lama"]); // Foto sebelumnya
        $folder_tujuan = "../images/";
        $nama_file = $_FILES["foto"]["name"];
        $lokasi_simpan = $folder_tujuan . $nama_file;

        // Pindahkan foto yang diunggah
        move_uploaded_file($_FILES["foto"]["tmp_name"], $lokasi_simpan);

        // Gunakan foto yang baru diunggah
        $foto = $nama_file;
    } else {
        // Jika tidak ada perubahan foto, gunakan foto yang ada sebelumnya
        $foto = htmlspecialchars($data["foto_lama"]);
    }

    // Query update
    $sql = "UPDATE tb_client SET nama_client = '$nama', alamat = '$alamat', jenis_kelamin = '$gender', nomor_telepon = '$nomor', email = '$email', tanggal_masuk = '$tanggal', foto_client = '$foto' WHERE id_client = '$id'";
    
    mysqli_query($connection_database, $sql);
    return mysqli_affected_rows($connection_database);
}
?>
