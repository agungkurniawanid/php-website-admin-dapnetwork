<?php
require 'connection.php';

function hapusPengeluaran($id) {
    global $connection_database;
    $query = "DELETE FROM tb_pengeluaran WHERE id_pengeluaran = ?";
    $stmt = mysqli_prepare($connection_database, $query);
    mysqli_stmt_bind_param($stmt, "s", $id); // Ubah "s" menjadi "i" jika id_pengeluaran berupa bilangan bulat
    mysqli_stmt_execute($stmt);
    $affected_rows = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $affected_rows;
}
?>
