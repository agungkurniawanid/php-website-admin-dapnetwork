<?php 
require 'connection.php';

// generate id paket 
function GenerateIDPaket() {
    global $connection_database;
    $prefix = 'DAPPAKET';
    $is_unique = false;
    while (!$is_unique) {
        $randomIDNumbers = mt_rand(10000000000, 99999999999);
        $id_client = $prefix . $randomIDNumbers;
        $result = mysqli_query($connection_database, "SELECT id_paket_layanan FROM tb_paket_layanan WHERE id_paket_layanan = '$id_client'");
        if (!mysqli_fetch_assoc($result)) {
            $is_unique = true;
        }
    }
    return $id_client;
}
function insertPaket($data) {
    global $connection_database;
    $id = GenerateIDPaket();
    $jenislayanan = $data['jenislayanan'];
    $harga = htmlspecialchars(trim(stripslashes($data['harga'])));
    $deskripsi = htmlspecialchars(trim(stripslashes($data['deskripsi'])));

    // cek apakah sudah ada paket
    $result = mysqli_query($connection_database, "SELECT id_paket_layanan FROM tb_paket_layanan WHERE jenis_paket_layanan = '$jenislayanan'");
    if(mysqli_fetch_assoc($result)) {
        echo "<script>alert('Paket sudah ada!')</script>";
    } else {
        $query = mysqli_query($connection_database, "INSERT INTO tb_paket_layanan VALUES ('$id', '$jenislayanan', '$harga', '$deskripsi')");
        if($query) {
            return mysqli_affected_rows($connection_database);
        } else {
            echo "<script>alert('Error saat memasukkan data ke database!')</script>";
        }
    }
}
?>