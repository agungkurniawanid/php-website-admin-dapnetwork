<?php
require 'connectionapi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $KONEKSI = $connection_database;

    if ($KONEKSI) {
        $RESPONSE = [];

        $ID_PEMBAYARAN = trim($_POST['id_pembayaran']);
        $ID_CLIENT = trim($_POST['id_client']);
        $ID_PEMESANAN = trim($_POST['id_pemesanan']);
        $ID_PAKET_LAYANAN = trim($_POST['id_paket_layanan']);
        $TANGGAL_PEMBAYARAN = date("Y-m-d");
        $TOTAL_PEMBAYARAN = trim($_POST['total_pembayaran']);
        $METODE_PEMBAYARAN = 'Cash';
        $NOMINAL_PEMBAYARAN = trim($_POST['nominal_pembayaran']);
        $KURANG_PEMBAYARAN = trim($_POST['kurang_pembayaran']);
        $KEMBALIAN_PEMBAYARAN = trim($_POST['kembalian_pembayaran']);
        $BUKTI_PEMBAYARAN = null;
        $STATUS_PEMBAYARAN = trim($_POST['status_pembayaran']);

        $SQL_TABLE_CATATAN_PEMBAYARAN = "INSERT INTO tb_catatan_pembayaran VALUES (
            '',
            '$ID_PEMBAYARAN',
            '$ID_CLIENT',
            '$ID_PEMESANAN',
            '$ID_PAKET_LAYANAN',
            '$TANGGAL_PEMBAYARAN',
            '$TOTAL_PEMBAYARAN',
            '$METODE_PEMBAYARAN',
            '$NOMINAL_PEMBAYARAN',
            '$KURANG_PEMBAYARAN',
            '$KEMBALIAN_PEMBAYARAN',
            '$BUKTI_PEMBAYARAN',
            '$STATUS_PEMBAYARAN'
        )";

        $SQL_TABLE_PEMBAYARAN = "UPDATE tb_pembayaran SET
        tanggal_pembayaran = '$TANGGAL_PEMBAYARAN',
        total_pembayaran = '$TOTAL_PEMBAYARAN',
        metode_pembayaran = '$METODE_PEMBAYARAN',
        nominal_pembayaran = '$NOMINAL_PEMBAYARAN',
        kurang_pembayaran = '$KURANG_PEMBAYARAN',
        kembalian_pembayaran = '$KEMBALIAN_PEMBAYARAN',
        bukti_pembayaran = '$BUKTI_PEMBAYARAN',
        status_pembayaran = '$STATUS_PEMBAYARAN'
        WHERE id_pembayaran = '$ID_PEMBAYARAN'";


        $EXEC1 = mysqli_query($KONEKSI, $SQL_TABLE_CATATAN_PEMBAYARAN);
        $EXEC2 = mysqli_query($KONEKSI, $SQL_TABLE_PEMBAYARAN);

        if ($EXEC1 && $EXEC2) {
            $RESPONSE = [
                'status' => 200,
                'message' => 'Data pembayaran berhasil ditambahkan'
            ];
        } else {
            $RESPONSE = [
                'status' => 500,
                'message' => 'Data pembayaran gagal ditambahkan',
                'error' => mysqli_error($KONEKSI)
            ];
        }
        echo json_encode($RESPONSE);
    }
}
