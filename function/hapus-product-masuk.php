<?php
require 'connection.php';
function hapusProductMasuk($id) {
global $connection_database;
$query = "DELETE FROM tb_product_masuk WHERE id_product = ?";
$stmt = mysqli_prepare($connection_database, $query);
mysqli_stmt_bind_param($stmt, "s", $id); // Menggunakan "s" karena ID adalah VARCHAR
mysqli_stmt_execute($stmt);
$affected_rows = mysqli_stmt_affected_rows($stmt);
mysqli_stmt_close($stmt);
return $affected_rows;
}
?>