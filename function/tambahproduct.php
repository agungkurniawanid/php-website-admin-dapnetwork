<?php
require '../function/connection.php';

function GenerateIDProductMasuk() {
    global $connection_database;
    $prefix = 'DAPBRGMASUK';
    $is_unique = false;
    
    while (!$is_unique) {
        $randomIDNumbers = mt_rand(100000000, 999999999);
        $id_product_masuk = $prefix . $randomIDNumbers;
        $result = mysqli_query($connection_database, "SELECT id_product_masuk FROM tb_product_masuk WHERE id_product_masuk = '$id_product_masuk'");
        
        if (!mysqli_fetch_assoc($result)) {
            $is_unique = true;
        }
    }
    
    return $id_product_masuk;
}

function tambahProductMasuk($data) {
    global $connection_database;
    
    // Escape input untuk menghindari SQL injection
    $id_product = mysqli_real_escape_string($connection_database, $data['namaproduct']);
    $jumlah_masuk = (int) htmlspecialchars(trim($data['jumlahmasuk']));
    
    $id_product_masuk = GenerateIDProductMasuk();
    $tanggal_masuk = date('Y-m-d');
    
    $SQL = "INSERT INTO tb_product_masuk (id_product_masuk, id_product, tanggal_masuk, jumlah_masuk) VALUES ('$id_product_masuk', '$id_product', '$tanggal_masuk', '$jumlah_masuk')";
    
    $query = mysqli_query($connection_database, $SQL);
    
    if ($query) {
        return mysqli_affected_rows($connection_database);
    }
    
    return -1; // Return -1 for failure
} 
?>
