<?php 
require 'connection.php';
function UPDATEPAKET($data){
    global $connection_database;
    $id = $data['idpaketlayanan'];
    $jenispaket = $data['jenispaketlayanan'];
    $harga = $data['harga'];
    $deskripsipaket = $data['deskripsipaket'];

    $sql = "UPDATE tb_paket_layanan SET jenis_paket_layanan = '$jenispaket', harga = '$harga', deskripsi_paket_layanan = '$deskripsipaket' WHERE id_paket_layanan = '$id'";
    mysqli_query($connection_database, $sql);
    return mysqli_affected_rows($connection_database);
}
?>