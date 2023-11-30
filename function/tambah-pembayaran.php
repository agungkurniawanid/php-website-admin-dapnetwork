<?php
require '../function/connection.php';

function tambahPembayaran($data)
{
    global $connection_database;

    $ID_PEMBAYARAN = trim($data['id_pembayaran']);
    $ID_CLIENT = trim($data['id_client']);
    $ID_PEMESANAN = trim($data['id_pemesanan']);
    $ID_PAKET_LAYANAN = trim($data['id_paket_layanan']);
    $TANGGAL_PEMBAYARAN = date("Y-m-d");
    $TOTAL_PEMBAYARAN = trim($data['total_pembayaran']);
    $METODE_PEMBAYARAN = 'Cash';
    $NOMINAL_PEMBAYARAN = trim($data['nominal_pembayaran']);
    $KURANG_PEMBAYARAN = trim($data['kurang_pembayaran']);
    $KEMBALIAN_PEMBAYARAN = trim($data['kembalian_pembayaran']);
    $STATUS_PEMBAYARAN = trim($data['status_pembayaran']);

    if (isset($_FILES['foto']['name']) && !empty($_FILES['foto']['name'])) {
        $BUKTI_PEMBAYARAN = $_FILES['foto']['name'];
        $TARGET_DIRECTORY = "../images/";

        if (!is_dir($TARGET_DIRECTORY)) {
            mkdir($TARGET_DIRECTORY, 0777, true);
        }

        $TARGET_PATH = $TARGET_DIRECTORY . basename($BUKTI_PEMBAYARAN);

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $TARGET_PATH)) {
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
            $EXEC1 = mysqli_query($connection_database, $SQL_TABLE_CATATAN_PEMBAYARAN);

            if ($EXEC1) {
                if ($STATUS_PEMBAYARAN == 'Lunas') {
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
                    $EXEC2 = mysqli_query($connection_database, $SQL_TABLE_PEMBAYARAN);

                    if ($EXEC2) {
                        return mysqli_affected_rows($connection_database);
                    }
                }
                return mysqli_affected_rows($connection_database);
            }
        }
    } else {
        $BUKTI_PEMBAYARAN = null;
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
        $EXEC1 = mysqli_query($connection_database, $SQL_TABLE_CATATAN_PEMBAYARAN);

        if ($EXEC1) {
            if ($STATUS_PEMBAYARAN == 'Lunas') {
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
                $EXEC2 = mysqli_query($connection_database, $SQL_TABLE_PEMBAYARAN);

                if ($EXEC2) {
                    return mysqli_affected_rows($connection_database);
                }
            }
            return mysqli_affected_rows($connection_database);
        }
    }
}
