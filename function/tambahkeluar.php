<?php
require '../function/connection.php';

function GenerateIDProductKeluar() {
    global $connection_database;
    $prefix = 'DAPBRGKELUAR';
    $is_unique = false;
    
    while (!$is_unique) {
        $randomIDNumbers = mt_rand(10000000, 99999999);
        $id_product_keluar = $prefix . $randomIDNumbers;
        $result = mysqli_query($connection_database, "SELECT id_product_keluar FROM tb_product_keluar WHERE id_product_keluar = '$id_product_keluar'");
        
        if (!mysqli_fetch_assoc($result)) {
            $is_unique = true;
        }
    }
    
    return $id_product_keluar;
}

function tambahProductkeluar($data) {
    global $connection_database;
    
    // Escape input untuk menghindari SQL injection
    $id_product = mysqli_real_escape_string($connection_database, $data['namaproduct']);
    $jumlah_keluar = (int) htmlspecialchars(trim($data['jumlahkeluar']));
    
    $id_product_keluar = GenerateIDProductKeluar();
    $tanggal_keluar = date('Y-m-d');
    
    $SQL = "INSERT INTO tb_product_keluar (id_product_keluar, id_product, tanggal_keluar, jumlah_keluar) VALUES ('$id_product_keluar', '$id_product', '$tanggal_keluar', '$jumlah_keluar')";
    
    $query = mysqli_query($connection_database, $SQL);
    
    if ($query) {
        return mysqli_affected_rows($connection_database);
    }
    
    return -1; // Return -1 for failure
} 
?>
