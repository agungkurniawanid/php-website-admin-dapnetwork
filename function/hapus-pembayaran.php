<?php
require '../function/connection.php';

function hapusPembayaran($id, $id_client) {
    global $connection_database;

    $query = "DELETE FROM tb_catatan_pembayaran WHERE id_client = ? AND id_catatan_pembayaran = ?";
    $stmt = mysqli_prepare($connection_database, $query);

    // Menggunakan "i" untuk id_catatan_pembayaran yang merupakan integer
    // Menggunakan "s" untuk id_client yang merupakan string
    mysqli_stmt_bind_param($stmt, "is", $id, $id_client);

    mysqli_stmt_execute($stmt);
    $affected_rows = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);

    return $affected_rows;
}
?>
