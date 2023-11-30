<?php 
require 'connection.php';

// todo generate ID pengeluaran 
function GenerateIDPemasukan() {
    global $connection_database;
    $prefix = 'DAPPEMASUKAN';
    $is_unique = false;
    while (!$is_unique) {
        $randomIDNumbers = mt_rand(10000000, 99999999);
        $id_pemasukan = $prefix . $randomIDNumbers;
        $result = mysqli_query($connection_database, "SELECT id_pemasukan FROM tb_pemasukan WHERE id_pemasukan = '$id_pemasukan'");
        if (!mysqli_fetch_assoc($result)) {
            $is_unique = true;
        }
    }
    return $id_pemasukan;
}

// todo fungsi insert 
function InsertPemasukan($data) {
    global $connection_database;
    $id_pemasukan = GenerateIDPemasukan();
    $tanggal_pemasukan = date('Y-m-d');
    $sumber_pemasukan = htmlspecialchars(trim(stripslashes($data['sumberpemasukan'])));
    $deskripsi_pemasukan = htmlspecialchars(trim(stripslashes($data['deskripsipemasukan'])));
    $jumlah_nominal = htmlspecialchars(trim($data['jumlahnominal']));

    // Query untuk memasukkan data ke database
    $SQL = "INSERT INTO tb_pemasukan VALUES ('$id_pemasukan', '$tanggal_pemasukan', '$sumber_pemasukan', '$deskripsi_pemasukan', '$jumlah_nominal')";
    $PROSES = mysqli_query($connection_database, $SQL);
    if($PROSES) {
        return mysqli_affected_rows($connection_database);
    }
}
?>