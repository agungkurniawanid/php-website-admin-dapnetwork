<?php 
require 'connectionapi.php';

function generateID()
{
    global $connection_database;
    $prefix = 'DAPPEMESANAN';
    $is_unique = false;
    while (!$is_unique) {
        $randomIDNumbers = mt_rand(10000000, 99999999);
        $id_client = $prefix . $randomIDNumbers;
        $result = mysqli_query($connection_database, "SELECT id_pemesanan FROM tb_pemesanan WHERE id_pemesanan = '$id_client'");
        if (!mysqli_fetch_assoc($result)) {
            $is_unique = true;
        }
    }
    return $id_client;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $KONEKSI = $connection_database;
    if ($KONEKSI) {
        $ID_PEMESANAN = generateID(); // Assuming you have a function to generate the ID
        $ID_CLIENT = $_POST['id_client'];
        $TANGGAL_PESAN = date('Y-m-d');
        $NAMA_BANK = trim($_POST['nama_bank']);
        $NOMOR_REKENING = trim($_POST['rekening']);
        $TANGGAL_INSTALASI = date('Y-m-d');
        $STATUS_PEMESANAN = 'Selesai';
        $CATATAN = trim($_POST['catatan_client']);
        $ID_PAKET_LAYANAN = $_POST['id_paket_layanan'];

        // Validate or sanitize input if needed

        $SQL = "INSERT INTO tb_pemesanan VALUES (
            '$ID_PEMESANAN', '$ID_CLIENT', '$TANGGAL_PESAN', '$NAMA_BANK', '$NOMOR_REKENING',
            '$TANGGAL_INSTALASI', '$STATUS_PEMESANAN', '$CATATAN', '$ID_PAKET_LAYANAN'
            )";
        $EXECUTE = mysqli_query($connection_database, $SQL);

        if ($EXECUTE) {

            $AMBIL_HARGA_PAKET = mysqli_query($KONEKSI, "
            SELECT * FROM tb_paket_layanan WHERE id_paket_layanan = '$ID_PAKET_LAYANAN'
            ");

            $RESPONSE = array(
                'status' => "200",
                'message' => 'Data pemesanan berhasil ditambahkan!',
                'id_pemesanan' => $ID_PEMESANAN,
                'id_client' => $ID_CLIENT,
                'id_paket_layanan' => $ID_PAKET_LAYANAN,
                'total_harga' => mysqli_fetch_assoc($AMBIL_HARGA_PAKET)['harga']
            );
            echo json_encode($RESPONSE);
        } else {
            $RESPONSE = array('status' => "400", 'message' => 'Data pemesanan gagal ditambahkan!');
            echo json_encode($RESPONSE);
        }
    } else {
        $RESPONSE = array('status' => "400", 'message' => 'Koneksi database gagal!');
        echo json_encode($RESPONSE);
    }
} else {
    $RESPONSE = array('status' => "400", 'message' => 'Metode request tidak valid!');
    echo json_encode($RESPONSE);
}
?>