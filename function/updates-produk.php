<?php
require 'connection.php';

function UpdateProduk($data){
    global $connection_database;

    $ID_PRODUK = $data['wup-idproduct'];
    $NAMA_PRODUK = htmlspecialchars(trim(stripslashes($data['wup-namaproduk'])));
    $DESKRIPSI_PRODUK = htmlspecialchars(trim(stripslashes($data['wup-deskripsiproduk'])));
    $STOK = htmlspecialchars(trim($data['wup-stokproduk']));
    $MEREK = htmlspecialchars(trim($data['wup-merekproduk']));
    $STATUS = $data['wup-statusproduk'];
    $KATEGORI = $data['wup-kategoriproduk'];
    $HARGA = htmlspecialchars(trim($data['wup-hargaproduk']));

    if (!empty($_FILES["wup-fotoproduk"]["name"])) {
        $foto_lama = htmlspecialchars($data["fotolamaproduk"]); // Foto sebelumnya
        $folder_tujuan = "../images/";
        $nama_file = $_FILES["wup-fotoproduk"]["name"];
        $lokasi_simpan = $folder_tujuan . $nama_file;

        // Pindahkan foto yang diunggah
        move_uploaded_file($_FILES["wup-fotoproduk"]["tmp_name"], $lokasi_simpan);

        // Gunakan foto yang baru diunggah
        $foto = $nama_file;
    } else {
        // Jika tidak ada perubahan foto, gunakan foto yang ada sebelumnya
        $foto = htmlspecialchars($data["fotolamaproduk"]);
    }

    // Query update
    $sql = "UPDATE tb_product SET ";

    if (!empty($NAMA_PRODUK)) {
        $sql .= "nama_product = '$NAMA_PRODUK', ";
    }

    if (!empty($DESKRIPSI_PRODUK)) {
        $sql .= "deskripsi_product = '$DESKRIPSI_PRODUK', ";
    }

    if (!empty($STOK)) {
        $sql .= "stok_product = '$STOK', ";
    }

    if (!empty($MEREK)) {
        $sql .= "merek_product = '$MEREK', ";
    }

    if (!empty($STATUS)) {
        $sql .= "status_product = '$STATUS', ";
    }

    if (!empty($KATEGORI)) {
        $sql .= "kategori_product = '$KATEGORI', ";
    }

    if (!empty($HARGA)) {
        $sql .= "harga_product = '$HARGA', ";
    }

    if (!empty($foto)) {
        $sql .= "gambar_product = '$foto', ";
    }

    $sql = rtrim($sql, ', '); // Menghapus koma terakhir
    $sql .= " WHERE id_product = '$ID_PRODUK'";

    mysqli_query($connection_database, $sql);
    return mysqli_affected_rows($connection_database);
} 
?>
