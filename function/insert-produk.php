<?php
require 'connection.php';

function GenerateIDProduk() {
    global $connection_database;
    $prefix = 'DAPBARANG';
    $is_unique = false;
    while (!$is_unique) {
        $randomIDNumbers = mt_rand(10000000000, 99999999999);
        $id_product = $prefix . $randomIDNumbers;
        $result = mysqli_query($connection_database, "SELECT id_product FROM tb_product WHERE id_product = '$id_product'");
        if (!mysqli_fetch_assoc($result)) {
            $is_unique = true;
        }
    }
    return $id_product;
}

function InsertProduk($data) {
    global $connection_database;

    $ID_PRODUK = GenerateIDProduk();
    $NAMA_PRODUK = htmlspecialchars(trim(stripslashes($data['namaproduk'])));
    $DESKRIPSI_PRODUK = htmlspecialchars(trim(stripslashes($data['deskripsiproduk'])));
    $STOK = htmlspecialchars(trim($data['stokproduk']));
    $MEREK = htmlspecialchars(trim($data['merekproduk']));
    $TANGGAL_DITAMBAH = date('Y-m-d');
    $STATUS = 'Tersedia';
    $KATEGORI = $data['kategoriproduk'];
    $HARGA = htmlspecialchars(trim($data['hargaproduk']));

    // Cek apakah file foto diunggah
    if (isset($_FILES['fotoproduk']['name']) && !empty($_FILES['fotoproduk']['name'])) {
        $FOTO = $_FILES['fotoproduk']['name'];
        $target_directory = "images/";

        // Buat direktori jika belum ada
        if (!is_dir($target_directory)) {
            mkdir($target_directory, 0755, true);
        }

        $target_path = $target_directory . basename($FOTO);

        if (move_uploaded_file($_FILES['fotoproduk']['tmp_name'], $target_path)) {
            // Query untuk memasukkan data ke database
            $query_registration  = "INSERT INTO tb_product VALUES ('$ID_PRODUK', '$NAMA_PRODUK', '$DESKRIPSI_PRODUK', '$STOK', '$MEREK', '$TANGGAL_DITAMBAH', '$FOTO', '$STATUS', '$KATEGORI', '$HARGA')";
            $registration = mysqli_query($connection_database, $query_registration);

            if ($registration) {
                return mysqli_affected_rows($connection_database);
            } else {
                echo "<script>alert('Error saat memasukkan data ke database!')</script>";
            }
        } else {
            echo "<script>alert('Error saat mengunggah foto!')</script>";
        }
    } else {
        // Jika foto tidak diunggah, gunakan foto default
        $FOTO = "../images/default.png";

        // Query untuk memasukkan data ke database
        $query_registration  = "INSERT INTO tb_product VALUES ('$ID_PRODUK', '$NAMA_PRODUK', '$DESKRIPSI_PRODUK', '$STOK', '$MEREK', '$TANGGAL_DITAMBAH',  '$FOTO', '$STATUS', '$KATEGORI', '$HARGA')";
        $registration = mysqli_query($connection_database, $query_registration);

        if ($registration) {
            return mysqli_affected_rows($connection_database);
        } else {
            echo "<script>alert('Error saat memasukkan data ke database!')</script>";
        }
    }
}
?>
