<?php
require 'connectionapi.php';
if($_SERVER['REQUEST_METHOD'] === 'GET') {
    if($connection_database) {
        $SQL = "SELECT * FROM tb_paket_layanan";
        $SQL_EXEC = mysqli_query($connection_database, $SQL);
        $RESPONSE = [];
        while($ROW = mysqli_fetch_assoc($SQL_EXEC)) {
            $DATA = [
                'id_paket_layanan' => $ROW['id_paket_layanan'],
                'jenis_paket_layanan' => $ROW['jenis_paket_layanan'],
                'harga' => $ROW['harga'],
                'deskripsi_paket_layanan' => $ROW['deskripsi_paket_layanan']
            ];
            $RESPONSE[] = $DATA;
        }
        echo json_encode(['status' => 'success', 'data' => $RESPONSE], JSON_PRETTY_PRINT);
    }
}
?>