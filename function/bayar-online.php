<?php
require 'connection.php';

function bayarOnline($DATA) {
    global $connection_database;

    if ($connection_database) {
        $ID_PEMBAYARAN = trim($DATA['id_pembayaran']);
        $ID_CLIENT = trim($DATA['id_client']);
        $ID_PEMESANAN = trim($DATA['id_pemesanan']);
        $ID_PAKET_LAYANAN = trim($DATA['id_paket_layanan']);
        $TANGGAL_PEMBAYARAN = date("Y-m-d");
        $TOTAL_PEMBAYARAN = trim($DATA['total_pembayaran']);
        $METODE_PEMBAYARAN = 'Transfer';
        $NOMINAL_PEMBAYARAN = 0;
        $KURANG_PEMBAYARAN = 0;
        $KEMBALIAN_PEMBAYARAN = 0;
        $BUKTI_PEMBAYARAN = '';

        if (isset($_FILES['foto']['name'])) {
            $FOTO = $_FILES['foto']['name'];
            $DIRECTORY = "images/";

            if (!is_dir($DIRECTORY)) {
                mkdir($DIRECTORY, 0755, true);
            }

            $PATH = $DIRECTORY . basename($FOTO);

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $PATH)) {
                $BUKTI_PEMBAYARAN = $FOTO;
            } else {
                echo "<script>alert('Error saat mengunggah foto!')</script>";
                return false;
            }
        } else {
            echo "<script>alert('Foto harus diunggah!')</script>";
            return false;
        }

        $STATUS_PEMBAYARAN = 'Lunas';

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

        $EXEC1 = mysqli_query($connection_database, $SQL_TABLE_CATATAN_PEMBAYARAN);
        $EXEC2 = mysqli_query($connection_database, $SQL_TABLE_PEMBAYARAN);

        if ($EXEC1 && $EXEC2) {
            return mysqli_affected_rows($connection_database);
        } else {
            echo mysqli_error($connection_database);
            return false;
        }
    }
}
?>
