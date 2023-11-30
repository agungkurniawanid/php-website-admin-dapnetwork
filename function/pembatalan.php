<?php
require 'function/connection.php';

// todo generate id pembatalan 
function GenerateIDPembatalan()
{
    global $connection_database;
    $prefix = 'DAPPEMBATALAN';
    $is_unique = false;
    while (!$is_unique) {
        $randomIDNumbers = mt_rand(10000000000, 99999999999);
        $id_pembatalan = $prefix . $randomIDNumbers;
        $result = mysqli_query($connection_database, "SELECT id_pembatalan FROM tb_pembatalan WHERE id_pembatalan = '$id_pembatalan'");
        if (!mysqli_fetch_assoc($result)) {
            $is_unique = true;
        }
    }
    return $id_pembatalan;
}

function pembatalan($data)
{
    global $connection_database;

    // Assuming deadline is one day before the tanggal_instalasi
    $deadline_date = date('Y-m-d', strtotime($data['tglpesan']));

    // Get the current date
    $current_date = date('Y-m-d');

    // Check if the current date is before or equal to the deadline
    if ($current_date < $deadline_date ) {
        $id_pembatalan = GenerateIDPembatalan();
        $id_pemesanan = $data['idpemesanan'];
        $id_client = $data['idclient'];
        $tanggal_pembatalan = date('Y-m-d');
        $alasan_pembatalan = htmlspecialchars(trim($data['alasan']));
        $status_pembatalan = 'Dibatalkan';

        // Hapus data dari tb_pembayaran
        $query_pembayaran = "UPDATE tb_pembayaran SET status_pembayaran = 'Dibatalkan' WHERE id_pemesanan = '$id_pemesanan'";
        $hapuspembayaran = mysqli_query($connection_database, $query_pembayaran);

        // update data dari tb_pemesanan
        $query_pemesanan = "UPDATE tb_pemesanan SET status_pemesanan_instalasi ='Dibatalkan' WHERE id_pemesanan = '$id_pemesanan'";
        $hapuspemesanan = mysqli_query($connection_database, $query_pemesanan);

        $query = "INSERT INTO tb_pembatalan (id_pembatalan, id_pemesanan, id_client, tanggal_pembatalan, alasan_pembatalan, status_pembatalan) 
                  VALUES ('$id_pembatalan', '$id_pemesanan','$id_client', '$tanggal_pembatalan', '$alasan_pembatalan', '$status_pembatalan')";
        $pembatalan = mysqli_query($connection_database, $query);

        if ($pembatalan && $hapuspembayaran && $hapuspemesanan) {
            return mysqli_affected_rows($connection_database);
        } else {
            echo "<script>alert('Error saat memasukkan data ke database!')</script>";
        }
    } else {
        echo "<script>alert('Batas waktu pembatalan telah berakhir!')</script>";
    }
}
