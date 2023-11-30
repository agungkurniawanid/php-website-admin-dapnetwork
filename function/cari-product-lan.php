<?php
require 'connection.php';

if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];

    $query = "SELECT * FROM tb_product WHERE kategori_product = 'LAN' AND (nama_product LIKE '%$keyword%' OR merek_product LIKE '%$keyword%' OR harga_product LIKE '%$keyword%') ORDER BY harga_product ASC";
    $result = mysqli_query($connection_database, $query);

    if (mysqli_num_rows($result) > 0) {
        $nomorProduk = 1;
        while ($product = mysqli_fetch_assoc($result)) {
            echo "<a class='wrapper-router' href='page/page-update-product.php?nama_product={$product['nama_product']}'>
                    <div class='gambar-router'><img src='images/{$product['gambar_product']}' alt='router'>
                        <p>{$product['status_product']}</p>
                    </div>
                    <div class='name-id'>
                        <p>{$product['nama_product']}</p>
                    </div>
                    <div class='id-product'>Rp. " . number_format($product['harga_product'], 0, ',', '.') . "</div>
                    <div class='kategori'>
                        <p>Kategori</p>
                        <p>{$product['kategori_product']}</p>
                    </div>
                    <div class='merek'>
                        <p>merek</p>
                        <p>{$product['merek_product']}</p>
                    </div>
                    <div class='stok'>
                        <p>Stok Barang</p>
                        <p>{$product['stok_product']} Pcs</p>
                    </div>
                </a>";
            $nomorProduk++;
        }
    } else {
        echo "<div class='body' style='width: 100%; display: flex; justify-content: center; align-items: center;'>
                <div>
                    <div class='img-notdata-produk'><img src='svg/404.svg' alt='404'></div>
                    <p style='text-align: center;'>Oopss... Data tidak ditemukan &#x1F622;</p>
                </div>
            </div>";
    }
}
?>