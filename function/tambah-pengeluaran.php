<?php 
require 'connection.php';

// todo generate ID pengeluaran 
function GenerateIDPengeluaran() {
    global $connection_database;
    $prefix = 'DAPPENGELUARAN';
    $is_unique = false;
    while (!$is_unique) {
        $randomIDNumbers = mt_rand(100000, 999999);
        $id_pengeluaran = $prefix . $randomIDNumbers;
        $result = mysqli_query($connection_database, "SELECT id_pengeluaran FROM tb_pengeluaran WHERE id_pengeluaran = '$id_pengeluaran'");
        if (!mysqli_fetch_assoc($result)) {
            $is_unique = true;
        }
    }
    return $id_pengeluaran;
}

// todo fungsi insert 
function Insertpengeluaran($data) {
    global $connection_database;
    $id_pengeluaran = GenerateIDpengeluaran();
    $tanggal_pengeluaran = date('Y-m-d');
    $sumber_pengeluaran = htmlspecialchars(trim(stripslashes($data['kategoripengeluaran'])));
    $deskripsi_pengeluaran = htmlspecialchars(trim(stripslashes($data['deskripsipengeluaran'])));
    $jumlah_nominal = htmlspecialchars(trim($data['jumlahnominal']));

    // Query untuk memasukkan data ke database
    $SQL = "INSERT INTO tb_pengeluaran VALUES ('$id_pengeluaran', '$tanggal_pengeluaran', '$sumber_pengeluaran', '$deskripsi_pengeluaran', '$jumlah_nominal')";
    $PROSES = mysqli_query($connection_database, $SQL);
    if($PROSES) {
        return mysqli_affected_rows($connection_database);
    }
}
?>