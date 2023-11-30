<?php
require 'function/connection.php';

// generate id pembayaran
function generateIDPembayaran() {
    global $connection_database;
    $prefix = 'DAPPEMBAYARAN';
    $is_unique = false;
    while (!$is_unique) {
        $randomIDNumbers = mt_rand(10000000000, 99999999999);
        $id_pembayaran = $prefix . $randomIDNumbers;
        $result = mysqli_query($connection_database, "SELECT id_pembayaran FROM tb_pembayaran WHERE id_pembayaran = '$id_pembayaran'");
        if (!mysqli_fetch_assoc($result)) {
            $is_unique = true;
        }
    }
    return $id_pembayaran;
}

function pembayaran($data) {
    global $connection_database;
    $id_pembayaran = generateIDPembayaran();
    $id_client = $data['idclient'];
    $id_pemesanan = $data['idpemesanan'];
    $id_paket = $data['idpaketlayanan'];
    $tanggal_pembayaran = date('Y-m-d');
    $total_pembayaran = $data['totalpembayaran'];
    $metode_pembayaran = 'Transfer';
    $nominal_pembayaran = 0;
    $kurang_pembayaran = 0;
    $kembalian_pembayaran = 0;

    // Mengunggah file bukti pembayaran
    $bukti_pembayaran = '';

    if (isset($_FILES['foto']['name']) && !empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto']['name'];
        $target_directory = "images/";

        // Buat direktori jika belum ada
        if (!is_dir($target_directory)) {
            mkdir($target_directory, 0755, true);
        }

        $target_path = $target_directory . basename($foto);

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_path)) {
            $bukti_pembayaran = $foto;
        } else {
            echo "<script>alert('Error saat mengunggah foto!')</script>";
            return false;
        }
    } else {
        echo "<script>alert('Foto harus diunggah!')</script>";
        return false;
    }

    $status_pembayaran = 'Lunas';

    // Query untuk memasukkan data ke database
    $query_pembayaran = "INSERT INTO tb_pembayaran (id_pembayaran, id_client, id_pemesanan, id_paket_layanan, tanggal_pembayaran, total_pembayaran, metode_pembayaran, nominal_pembayaran, kurang_pembayaran, kembalian_pembayaran, bukti_pembayaran, status_pembayaran) VALUES ('$id_pembayaran', '$id_client', '$id_pemesanan', '$id_paket', '$tanggal_pembayaran', '$total_pembayaran', '$metode_pembayaran', '$nominal_pembayaran', '$kurang_pembayaran', '$kembalian_pembayaran', '$bukti_pembayaran', '$status_pembayaran')";

    $pembayaran = mysqli_query($connection_database, $query_pembayaran);

    if ($pembayaran) {
        return mysqli_affected_rows($connection_database);
    } else {
        echo "<script>alert('Error saat memasukkan data ke database!')</script>";
        return false;
    }
}
?>
