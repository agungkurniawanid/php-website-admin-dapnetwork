<?php 
require 'connection.php';
function UPDATEPEGAWAI($data) {
    global $connection_database;
    $id = $data["id_pegawai"];
    $namaawal = htmlspecialchars($data["namaawal"]);
    $namaakhir = htmlspecialchars($data["namaakhir"]);
    $nik = htmlspecialchars($data["nik"]);
    $jeniskelamin = htmlspecialchars($data["jeniskelamin"]);
    $tanggallahir = htmlspecialchars($data["tanggallahir"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $nomor = htmlspecialchars($data["nomor"]);
    $email = htmlspecialchars($data["email"]);
    $jabatan = htmlspecialchars($data["jabatan"]);
    $gaji = htmlspecialchars($data["gaji"]);
    $tanggalmasuk = date("Y-m-d");
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    $status = htmlspecialchars($data["status"]);
    $hak_akses_pegawai = htmlspecialchars($data["akses"]);
    $agama = htmlspecialchars($data["agama"]);

    // cek apakah ada foto diunggah 
    if(!empty($_FILES['foto']['name'])) {
        $foto_lama = htmlspecialchars($data["foto_lama"]);
        $folder_tujuan = "../images/";
        $nama_file = $_FILES['foto']['name'];
        $lokasi_simpan = $folder_tujuan . $nama_file;

        // pindahkan foto yang diunggah
        move_uploaded_file($_FILES['foto']['tmp_name'], $lokasi_simpan);
        $foto = $nama_file;
    } else {
        $foto = htmlspecialchars($data["foto_lama"]);
    }
    $sql = "UPDATE tb_pegawai SET 
    nama_awal = '$namaawal',
    nama_akhir = '$namaakhir',
    nik = '$nik',
    jenis_kelamin = '$jeniskelamin',
    tanggal_lahir = '$tanggallahir',
    alamat = '$alamat',
    nomor_telepon = '$nomor',
    email = '$email',
    jabatan = '$jabatan',
    gaji = '$gaji',
    username = '$username',
    password = '$password',
    status = '$status',
    hak_akses_pegawai = '$hak_akses_pegawai',
    agama = '$agama',
    foto_pegawai = '$foto' WHERE id_pegawai = '$id'";
    mysqli_query($connection_database, $sql);
    return mysqli_affected_rows($connection_database);
}
?>