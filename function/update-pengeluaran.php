<?php 
require 'connection.php';
function updatePengeluaran($data) {
    global $connection_database;
    $id_pemasukan = $data['idpengeluaran'];
    $sumber_pemasukan = htmlspecialchars(trim(stripslashes($data['kategoripengeluaran'])));
    $deskripsi_pemasukan = htmlspecialchars(trim(stripslashes($data['deskripsipengeluaran'])));
    $jumlah_nominal = htmlspecialchars(trim($data['jumlahnominal']));

    // Query untuk memasukkan data ke database
    $SQL = "UPDATE tb_pengeluaran SET kategori_pengeluaran = '$sumber_pemasukan', deskripsi_pengeluaran = '$deskripsi_pemasukan', jumlah_nominal = '$jumlah_nominal' WHERE id_pengeluaran = '$id_pemasukan'";
    $PROSES = mysqli_query($connection_database, $SQL);
    if($PROSES) {
        return mysqli_affected_rows($connection_database);
    }
}
?>