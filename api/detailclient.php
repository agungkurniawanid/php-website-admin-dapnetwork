<?php 
require 'connectionapi.php';

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $KONEKSI = $connection_database;
    $ID_CLIENT = $_GET['id_client'];
    $RESPONSE = array();
    if($KONEKSI) {
        $SQL = "SELECT * FROM tb_client JOIN tb_pemesanan ON tb_pemesanan.id_client = tb_client.id_client
        JOIN tb_paket_layanan ON tb_pemesanan.id_paket_layanan = tb_paket_layanan.id_paket_layanan 
        WHERE tb_client.id_client = '$ID_CLIENT'";
        $EXEC = mysqli_query($KONEKSI, $SQL);
        $RESPONSE = array();
        while($ROW = mysqli_fetch_assoc($EXEC)) {
            $DATA = [
                'catatan' => $ROW['catatan'],
                'harga' => number_format($ROW['harga']),
                'status_client' => $ROW['status_client'],
                'jenis_kelamin' => $ROW['jenis_kelamin'],
                'nomor_telepon' => $ROW['nomor_telepon'],
                'alamat' => $ROW['alamat'],
                'email' => $ROW['email']
            ];
            $RESPONSE[] = $DATA;
        }
        echo json_encode(array('data' => $RESPONSE));
    }
}
?>