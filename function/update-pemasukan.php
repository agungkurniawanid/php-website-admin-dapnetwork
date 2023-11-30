<?php 
require 'connection.php';
function updatePemasukan($data) {
    global $connection_database;
    $id_pemasukan = $data['idpemasukan'];
    $sumber_pemasukan = htmlspecialchars(trim(stripslashes($data['sumberpemasukan'])));
    $deskripsi_pemasukan = htmlspecialchars(trim(stripslashes($data['deskripsipemasukan'])));
    $jumlah_nominal = htmlspecialchars(trim($data['jumlahnominal']));

    // Query untuk memasukkan data ke database
    $SQL = "UPDATE tb_pemasukan SET sumber_pemasukan = '$sumber_pemasukan', deskripsi_pemasukan = '$deskripsi_pemasukan', jumlah_nominal = '$jumlah_nominal' WHERE id_pemasukan = '$id_pemasukan'";
    $PROSES = mysqli_query($connection_database, $SQL);
    if($PROSES) {
        return mysqli_affected_rows($connection_database);
    }
}
?>