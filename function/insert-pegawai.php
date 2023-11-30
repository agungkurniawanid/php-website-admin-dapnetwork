<?php 
require 'connection.php';
function generate_id() {
    global $connection_database;
    $prefix = 'DAPNET';
    $is_unique = false;
    while (!$is_unique) {
        $randomNumbers = mt_rand(10000000000000, 99999999999999);
        $id_pegawai = $prefix . $randomNumbers;
        $result = mysqli_query($connection_database, "SELECT id_pegawai FROM tb_pegawai WHERE id_pegawai = '$id_pegawai'");
        if (!mysqli_fetch_assoc($result)) {
            $is_unique = true;
        }
    }
    return $id_pegawai;
}

// todo fungsi register 
function insertPegawai($data) {
    global $connection_database;
    $id_pegawai = generate_id();
    $nama_awal = htmlspecialchars(trim(stripslashes($data["namaawal"])));
    $nama_akhir = htmlspecialchars(trim(stripslashes($data["namaakhir"])));
    $nik = htmlspecialchars(trim($data["nik"]));
    $jenis_kelamin = htmlspecialchars(trim(stripslashes($data["jeniskelamin"])));
    $tanggal_lahir = htmlspecialchars(trim(stripslashes($data["tanggallahir"])));
    $alamat_lengkap = htmlspecialchars(trim($data["alamat"]));
    $nomor_telfon = htmlspecialchars(trim($data["nomor"]));
    $email = filter_var($data["email"], FILTER_VALIDATE_EMAIL) ? $data["email"] : null;
    $jabatan = $data['jabatan'];
    $gaji = htmlspecialchars(trim($data["gaji"]));
    $tanggal_masuk = date('Y-m-d');
    $foto_pegawai = $_FILES['foto']['name'];
    $username = htmlspecialchars(trim($data["username"]));
    $password = password_hash($data["password"], PASSWORD_DEFAULT);
    $status = 'Aktif';
    $hak_akses = $data['akses'];
    $agama = htmlspecialchars(trim(stripslashes($data["agama"])));
    
    $result = mysqli_query($connection_database, "SELECT username FROM tb_pegawai WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>alert('Username sudah terdaftar!')</script>";
    } else {
        $target_directory = "images/";
        if (!is_dir($target_directory)) {
            mkdir($target_directory, 0755, true);
        }        
        $target_path = $target_directory . basename($foto_pegawai);
        
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_path)) {
            $query_registration  = "INSERT INTO tb_pegawai VALUES ('$id_pegawai', '$nama_awal', '$nama_akhir', '$nik', '$jenis_kelamin', '$tanggal_lahir', '$alamat_lengkap', '$nomor_telfon', '$email','$jabatan', '$gaji','$tanggal_masuk', '$foto_pegawai', '$username', '$password', '$status', '$hak_akses', '$agama')";
            $registration = mysqli_query($connection_database, $query_registration);
            
            if ($registration) {
                return mysqli_affected_rows($connection_database);
            } else {
                echo "<script>alert('Error saat memasukkan data ke database!')</script>";
            }
        } else {
            echo "<script>alert('Foto Wajib Di isi')</script>";
        }
    }
}
?>