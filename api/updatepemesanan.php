<?php 
require 'connectionapi.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $KONEKSI = $connection_database;
    if($KONEKSI) {
        $ID_PEMESANAN = $_POST['id_pemesanan'];
        $SQL = "UPDATE tb_pemesanan SET status_pemesanan_instalasi = 'Selesai' WHERE id_pemesanan = '$ID_PEMESANAN'";
        $SQL_EXEC = mysqli_query($KONEKSI, $SQL);
        if($SQL_EXEC) {
            echo json_encode(['status' => 200, 'message' => 'Pemesanan Di Update']);
        } else {
            echo json_encode(['status' => 'error', 'message' => mysqli_error($KONEKSI)]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Koneksi Database Gagal']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Method Not Allowed']);
}
?>