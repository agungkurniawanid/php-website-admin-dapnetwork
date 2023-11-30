<?php
require 'connection.php';

function hapus_pegawai($id) {
    global $connection_database;

    // Hapus dari tb_catatan_login terlebih dahulu
    $query_delete_catatan_login = "DELETE FROM tb_catatan_login WHERE id_pegawai = ?";
    $stmt_delete_catatan_login = mysqli_prepare($connection_database, $query_delete_catatan_login);
    mysqli_stmt_bind_param($stmt_delete_catatan_login, "s", $id); // Menggunakan "s" karena ID adalah VARCHAR
    mysqli_stmt_execute($stmt_delete_catatan_login);
    mysqli_stmt_close($stmt_delete_catatan_login);

    // Setelah itu baru hapus dari tb_pegawai
    $query_delete_pegawai = "DELETE FROM tb_pegawai WHERE id_pegawai = ?";
    $stmt_delete_pegawai = mysqli_prepare($connection_database, $query_delete_pegawai);
    mysqli_stmt_bind_param($stmt_delete_pegawai, "s", $id); // Menggunakan "s" karena ID adalah VARCHAR
    mysqli_stmt_execute($stmt_delete_pegawai);
    $affected_rows = mysqli_stmt_affected_rows($stmt_delete_pegawai);
    mysqli_stmt_close($stmt_delete_pegawai);

    return $affected_rows;
}
?>
