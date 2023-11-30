<?php 
// require 'connection.php';

// function hapus_client($id) {
//     global $connection_database;

//     $query = "
//         DELETE tb_client, tb_pemesanan, tb_pembayaran
//         FROM tb_client
//         LEFT JOIN tb_pemesanan ON tb_client.id_client = tb_pemesanan.id_client
//         LEFT JOIN tb_pembayaran ON tb_client.id_client = tb_pembayaran.id_client
//         WHERE tb_client.id_client = ?
//     ";

//     $stmt = mysqli_prepare($connection_database, $query);
//     mysqli_stmt_bind_param($stmt, "s", $id);
//     mysqli_stmt_execute($stmt);
//     $affected_rows = mysqli_stmt_affected_rows($stmt);
//     mysqli_stmt_close($stmt);

//     return $affected_rows;
// }

require 'connection.php';

function hapus_client($id) {
    global $connection_database;
    
    // Hapus data dari tb_pembayaran
    $query_pembayaran = "DELETE FROM tb_pembayaran WHERE id_client = ?";
    $stmt_pembayaran = mysqli_prepare($connection_database, $query_pembayaran);
    mysqli_stmt_bind_param($stmt_pembayaran, "s", $id);
    mysqli_stmt_execute($stmt_pembayaran);
    $affected_rows_pembayaran = mysqli_stmt_affected_rows($stmt_pembayaran);
    mysqli_stmt_close($stmt_pembayaran);

    // hapus data pembatalan
    $query_pembatalan = "DELETE FROM tb_pembatalan WHERE id_client = ?";
    $stmt_pembatalan = mysqli_prepare($connection_database, $query_pembatalan);
    mysqli_stmt_bind_param($stmt_pembatalan, "s", $id);
    mysqli_stmt_execute($stmt_pembatalan);
    $affected_rows_pembatalan = mysqli_stmt_affected_rows($stmt_pembatalan);
    mysqli_stmt_close($stmt_pembatalan);

    // Hapus data dari tb_pemesanan
    $query_pemesanan = "DELETE FROM tb_pemesanan WHERE id_client = ?";
    $stmt_pemesanan = mysqli_prepare($connection_database, $query_pemesanan);
    mysqli_stmt_bind_param($stmt_pemesanan, "s", $id);
    mysqli_stmt_execute($stmt_pemesanan);
    $affected_rows_pemesanan = mysqli_stmt_affected_rows($stmt_pemesanan);
    mysqli_stmt_close($stmt_pemesanan);

    // Hapus data dari tb_client
    $query_client = "DELETE FROM tb_client WHERE id_client = ?";
    $stmt_client = mysqli_prepare($connection_database, $query_client);
    mysqli_stmt_bind_param($stmt_client, "s", $id);
    mysqli_stmt_execute($stmt_client);
    $affected_rows_client = mysqli_stmt_affected_rows($stmt_client);
    mysqli_stmt_close($stmt_client);

    // Hitung jumlah total baris yang terpengaruh di semua tabel
    $total_affected_rows = $affected_rows_pembayaran + $affected_rows_pembatalan + $affected_rows_pemesanan + $affected_rows_client;

    return $total_affected_rows;
}
?>