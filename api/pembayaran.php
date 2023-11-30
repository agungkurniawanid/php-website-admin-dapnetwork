<?php 
require 'connectionapi.php';

function generate_id_pembayaran() {
    global $connection_database;
    $prefix = 'DAPPEMBAYARAN';
    $is_unique = false;
    while (!$is_unique) {
        $randomIDNumbers = mt_rand(1000000, 9999999);
        $id_pembayaran = $prefix . $randomIDNumbers;
        $result = mysqli_query($connection_database, "SELECT id_pembayaran FROM tb_pembayaran WHERE id_pembayaran = '$id_pembayaran'");
        if (!mysqli_fetch_assoc($result)) {
            $is_unique = true;
        }
    }
    return $id_pembayaran;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $KONEKSI = $connection_database;
    $RESPONSE = array();

    $ID_PEMBAYARAN = generate_id_pembayaran();
    $ID_CLIENT = $_POST['id_client'];
    $ID_PEMESANAN = $_POST['id_pemesanan'];
    $ID_PAKET = $_POST['id_paket_layanan'];
    $TANGGAL_PEMBAYARAN = date('Y-m-d');
    $TOTAL_PEMBAYARAN = trim($_POST['total_pembayaran']);
    $METODE_PEMBAYARAN = 'Cash';
    $NOMINAL_PEMBAYARAN = trim($_POST['nominal_pembayaran']);
    $KURANG_PEMBAYARAN = trim($_POST['kurang_pembayaran']);
    $KEMBALIAN_PEMBAYARAN = trim($_POST['kembalian_pembayaran']);
    $BUKTI_PEMBAYARAN = null;
    $STATUS_PEMBAYARAN = trim($_POST['status_pembayaran']);

    if($KONEKSI) {
        $SQL = "INSERT INTO tb_pembayaran VALUES (
            '$ID_PEMBAYARAN', '$ID_CLIENT', '$ID_PEMESANAN', '$ID_PAKET', '$TANGGAL_PEMBAYARAN',
            '$TOTAL_PEMBAYARAN', '$METODE_PEMBAYARAN', '$NOMINAL_PEMBAYARAN', '$KURANG_PEMBAYARAN',
            '$KEMBALIAN_PEMBAYARAN', '$BUKTI_PEMBAYARAN', '$STATUS_PEMBAYARAN'
        )";
        $EXEC = mysqli_query($KONEKSI, $SQL);
        if($EXEC) {
            $RESPONSE['status'] = 200;
            $RESPONSE['message'] = 'Data pembayaran berhasil ditambahkan!';
        } else {
            $RESPONSE['status'] = 400;
            $RESPONSE['message'] = 'Data pembayaran gagal ditambahkan!';
        }
    } else {
        $RESPONSE['status'] = 400;
        $RESPONSE['message'] = 'Koneksi database gagal!';
    }
} else {
    $RESPONSE = array();
    $RESPONSE['status'] = 400;
    $RESPONSE['message'] = 'Metode request tidak valid!';
}

header('Content-Type: application/json');
echo json_encode($RESPONSE);
?>