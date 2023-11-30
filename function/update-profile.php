<?php 
require 'connection.php';

function UpdateProfile($data){
    global $connection_database;

    $id = $data["id"];
    $nama_awal = htmlspecialchars($data["namaawal"]);
    $nama_akhir = htmlspecialchars($data["namaakhir"]);
    $nik = htmlspecialchars($data["nik"]);
    $jenis_kelamin = htmlspecialchars($data["jeniskelamin"]);
    $tanggal_lahir = htmlspecialchars($data["tanggallahir"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $nomor_telepon = htmlspecialchars($data["nomortelfon"]);
    $email = htmlspecialchars($data["email"]);
    $jabatan = htmlspecialchars($data["jabatan"]);
    $gaji = htmlspecialchars($data["gaji"]);
    $tanggal_masuk = htmlspecialchars($data["tanggalmasuk"]);
    $foto_lama = htmlspecialchars($data["fotolama"]);
    
    // Cek apakah file foto diunggah
    if (!empty($_FILES["foto"]["name"])) {
        $folder_tujuan = "../images/";
        $nama_file = $_FILES["foto"]["name"];
        $lokasi_simpan = $folder_tujuan . $nama_file;

        // Pindahkan foto yang diunggah
        move_uploaded_file($_FILES["foto"]["tmp_name"], $lokasi_simpan);

        // Gunakan foto yang baru diunggah
        $foto = $nama_file;
    } else {
        // Jika tidak ada perubahan foto, gunakan foto yang ada sebelumnya
        $foto = $foto_lama;
    }

    // Query update
    $sql = "UPDATE tb_pegawai SET 
            nama_awal = '$nama_awal', 
            nama_akhir = '$nama_akhir', 
            nik = '$nik', 
            jenis_kelamin = '$jenis_kelamin', 
            tanggal_lahir = '$tanggal_lahir', 
            alamat = '$alamat', 
            nomor_telepon = '$nomor_telepon', 
            email = '$email', 
            jabatan = '$jabatan', 
            gaji = '$gaji', 
            tanggal_masuk = '$tanggal_masuk', 
            foto_pegawai = '$foto' 
            WHERE id_pegawai = '$id'";
    
    mysqli_query($connection_database, $sql);

    // Periksa apakah update berhasil
    if (mysqli_affected_rows($connection_database) > 0) {
        return true; // Update berhasil
    } else {
        return false; // Update gagal
    }
}
?>
