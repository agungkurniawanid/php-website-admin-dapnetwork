<?php
require "connectionapi.php";

// Fungsi generate id
function generate_id()
{
    global $connection_database;
    $prefix = "DAPNET";
    $is_unique = false;
    while (!$is_unique) {
        $randomNumbers = mt_rand(10000000000000, 99999999999999);
        $id_pegawai = $prefix . $randomNumbers;
        $result = mysqli_query(
            $connection_database,
            "SELECT id_pegawai FROM tb_pegawai WHERE id_pegawai = '$id_pegawai'"
        );
        if (!mysqli_fetch_assoc($result)) {
            $is_unique = true;
        }
    }
    return $id_pegawai;
}

// Fungsi register
$id_pegawai = generate_id();
$nama_awal = htmlspecialchars(trim(stripslashes($_POST["namaawal"])));
$nama_akhir = htmlspecialchars(trim(stripslashes($_POST["namaakhir"])));
$nik = htmlspecialchars(trim($_POST["nik"]));
$jenis_kelamin = htmlspecialchars(trim(stripslashes($_POST["jeniskelamin"])));
$tanggal_lahir = htmlspecialchars(trim(stripslashes($_POST["tanggallahir"])));
$alamat_lengkap = htmlspecialchars(trim($_POST["alamat"]));
$nomor_telfon = htmlspecialchars(trim($_POST["notel"]));
$email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)
    ? $_POST["email"]
    : null;
$jabatan = "Teknisi";
$gaji = 5000000;
$tanggal_masuk = date("Y-m-d");
$username = htmlspecialchars(trim($_POST["username"]));
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
$status = "Aktif";
$hak_akses = "Teknisi";
$agama = htmlspecialchars(trim(stripslashes($_POST["agama"])));
$result = mysqli_query(
    $connection_database,
    "SELECT username FROM tb_pegawai WHERE username = '$username'"
);

$response = array();

$foto_pegawai = null;

// Ubah path penyimpanan sesuai dengan struktur file Anda
$path_storage = '../images/';

// Pastikan file gambar tersedia sebelum mencoba menyimpan path
if (isset($_POST['img'])) {
    $img_base64 = $_POST['img'];
    $img_data = base64_decode($img_base64);
    $img_name = $nama_awal . '-' . time() . '.jpg'; // Atau sesuaikan dengan format dan nama file yang diinginkan
    $img_path = $path_storage . $img_name;

    // Simpan file gambar di server
    file_put_contents($img_path, $img_data);

    // Set path gambar untuk disimpan di database
    $foto_pegawai = $img_path;
}

if (mysqli_fetch_assoc($result)) {
    $response['status'] = 'failed';
    $response['message'] = 'Username sudah terdaftar!';
} else {
    $query_registration = "INSERT INTO tb_pegawai VALUES ('$id_pegawai', '$nama_awal', '$nama_akhir', '$nik', '$jenis_kelamin', '$tanggal_lahir', '$alamat_lengkap', '$nomor_telfon', '$email','$jabatan', '$gaji','$tanggal_masuk', '$foto_pegawai', '$username', '$password', '$status', '$hak_akses', '$agama')";
    $registration = mysqli_query($connection_database, $query_registration);

    if ($registration) {
        $response['status'] = 'success';
        $response['message'] = 'Registrasi berhasil!';
    } else {
        $response['status'] = 'failed';
        $response['message'] = 'Registrasi gagal!';
    }
}

// Set header as JSON
header('Content-Type: application/json');

// Encode the response array to JSON format and echo
echo json_encode($response);
?>