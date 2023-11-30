<?php
require 'connection.php';

function cekNomorTelepon($data)
{
    global $connection_database;
    $KONEKSI = $connection_database;

    // Memeriksa koneksi
    if (!$KONEKSI) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    $NOMOR_TELEPON = $data['nomor-email'];

    $SQL_CEK1 = "SELECT * FROM tb_client JOIN tb_pembayaran ON tb_client.id_client = tb_pembayaran.id_client WHERE tb_client.nomor_telepon = '$NOMOR_TELEPON' AND tb_pembayaran.status_pembayaran = 'Lunas' AND MONTH(tb_pembayaran.tanggal_pembayaran) = MONTH(CURDATE()) AND YEAR(tb_pembayaran.tanggal_pembayaran) = YEAR(CURDATE())";
    $HASIL_CEK1 = mysqli_query($connection_database, $SQL_CEK1);

    if (mysqli_num_rows($HASIL_CEK1) > 0) {
        echo "<script>alert('Anda sudah melakukan pembayaran bulan ini')</script>";
    } else {
        $SQL_NOMOR = "SELECT * FROM tb_client WHERE nomor_telepon = '$NOMOR_TELEPON'";
        $HASIL_NOMOR = mysqli_query($connection_database, $SQL_NOMOR);
    
        if (mysqli_num_rows($HASIL_NOMOR) > 0) {
            return "nomor_terverifikasi";
        } else {
            return "tidak_terverifikasi";
        }
    }
}
?>
