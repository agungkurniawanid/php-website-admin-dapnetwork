<?php
require 'connectionapi.php';
if($_SERVER['REQUEST_METHOD'] === 'GET') {
    $KONEKSI = $connection_database;
    if($KONEKSI) {
        $SQL = "SELECT * FROM tb_paket_layanan ORDER BY harga ASC";
        $EXEC = mysqli_query($KONEKSI, $SQL);
        $RESPONSE = array();
        while($ROW = mysqli_fetch_assoc($EXEC)) {
            $DATA = array(
                'id_paket_layanan' => $ROW['id_paket_layanan'],
                'jenis_paket_layanan' => $ROW['jenis_paket_layanan'],
            );
            $RESPONSE[] = $DATA;
        }
        echo json_encode(array('data' => $RESPONSE));
    }
}
?>