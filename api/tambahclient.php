<?php
require "connectionapi.php";

// Fungsi generate id
function generate_id()
{
    global $connection_database;
    $prefix = "DAPCLIENT";
    $is_unique = false;
    while (!$is_unique) {
        $randomNumbers = mt_rand(10000000000, 99999999999);
        $id_client = $prefix . $randomNumbers;
        $result = mysqli_query(
            $connection_database,
            "SELECT id_client FROM tb_client WHERE id_client = '$id_client'"
        );
        if (!mysqli_fetch_assoc($result)) {
            $is_unique = true;
        }
    }
    return $id_client;
}

// Fungsi register
$id_client = generate_id();
$nama_lengkap = htmlspecialchars(trim(stripslashes($_POST["nama_lengkap"])));
$jenis_kelamin = htmlspecialchars(trim(stripslashes($_POST["jenis_kelamin"])));
$alamat = htmlspecialchars(trim($_POST["alamat"]));
$nomor_telepon = htmlspecialchars(trim($_POST["nomor_telepon"]));
$email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)
    ? $_POST["email"]
    : null;
$tanggal_masuk = date("Y-m-d");
$status = "Aktif";

$result = mysqli_query(
    $connection_database,
    "SELECT email FROM tb_client WHERE email = '$email'"
);

$response = array();

$foto_client = "../images/default.png";

// Ubah path penyimpanan sesuai dengan struktur file Anda
$path_storage = '../images/';

// Pastikan file gambar tersedia sebelum mencoba menyimpan path
if (isset($_POST['foto']) && !empty($_POST['foto'])) {
    $img_base64 = $_POST['foto'];
    $img_data = base64_decode($img_base64);
    $img_name = $nama_lengkap . '-' . time() . '.jpg'; // Atau sesuaikan dengan format dan nama file yang diinginkan
    $img_path = $path_storage . $img_name;

    // Simpan file gambar di server
    file_put_contents($img_path, $img_data);

    // Set path gambar untuk disimpan di database
    $foto_client = $img_path;
}

if (mysqli_fetch_assoc($result)) {
    $response['status'] = 'failed';
    $response['message'] = 'Email sudah terdaftar!';
} else {
    $query_registration = "INSERT INTO tb_client VALUES ('$id_client', '$nama_lengkap', '$jenis_kelamin', '$alamat', '$nomor_telepon', '$email', '$tanggal_masuk', '$foto_client', '$status')";
    $registration = mysqli_query($connection_database, $query_registration);

    if ($registration) {
        $response['status'] = 'success';
        $response['message'] = 'Registrasi berhasil!';
        $response['id_client'] = $id_client;
        $response['nama_client'] = $nama_lengkap;
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
