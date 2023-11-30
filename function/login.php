<?php
require 'connection.php';
// todo untuk fungsi login 
function Login($login) {
    global $connection_database;
    $username = htmlspecialchars(trim($login["username"]));
    $password = $login["password"];
    $hak_akses = $login["akses"];
    $result = mysqli_query($connection_database, "SELECT * FROM tb_pegawai WHERE username = '$username' and hak_akses_pegawai='$hak_akses'");
    if(mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            $_SESSION["loginmasuk"] = true;
            $_SESSION['fotopegawai'] = $row['foto_pegawai'];
            $_SESSION['namapegawai'] = $row['nama_awal'];
            $_SESSION['statuspegawai'] = $row['hak_akses_pegawai'];
            return $row;
        }
    }
    return null;
}
?>