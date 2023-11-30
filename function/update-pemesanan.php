<?php 
require 'connection.php';
function editPemesanan($DATA) {
    global $connection_database;
    if($connection_database) {
        $ID_PAKET_LAYANAN = $DATA['id_paket'];
        $NAMA_BANK = trim($DATA['bank']);
        $NOMOR_REKENING = trim($DATA['rekening']);
        $STATUS_INSTALASI = trim($DATA['status_instalasi']);
        $CATATAN_CLIENT = trim($DATA['catatan']);

        $SQL1 = "UPDATE tb_pemesanan SET 
            nama_bank = '$NAMA_BANK',
            nomor_rekening = '$NOMOR_REKENING',
            status_pemesanan_instalasi = '$STATUS_INSTALASI',
            catatan = '$CATATAN_CLIENT',
            id_paket_layanan = '$ID_PAKET_LAYANAN'
            WHERE id_pemesanan = '$_GET[pemesanan]'";

        $QUERY1 = mysqli_query($connection_database, $SQL1);
        if($QUERY1) {
            return mysqli_affected_rows($connection_database);
        }
    }
}
?>