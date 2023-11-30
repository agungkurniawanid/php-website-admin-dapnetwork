<?php
session_start();
if(!isset($_SESSION["loginmasuk"])) {
    header("Location: signin.php");
    exit;
}
$foto_profile = $_SESSION['fotopegawai'];
$nama_user = $_SESSION['namapegawai'];
$status_user = $_SESSION['statuspegawai'];
require 'function/connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="author" content="Agung Kurniawan" />
    <meta name="description" content="Halaman Pegawai" />
    <meta name="keywords" content="Halaman Pegawai" />
    <link rel="icon" type="image/x-icon" href="ico/dapnetwork.ico" />
    <link rel="stylesheet" href="css/all.css" />
    <link rel="stylesheet" href="css/sbr-halaman-pegawai.css"/>
    <link rel="stylesheet" href="css/nvb-halaman-pegawai.css"/>
    <link rel="stylesheet" href="css/page-halaman-pegawai.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Pegawai - DAPNETWORK</title>
</head>

<body>
    <div class="overlay-form-pegawai" id="overlay-form-pegawai"></div>
    <div><?php include 'components/popup/insert-pegawai.php' ?></div>
    <div class="container" style="width: 100%; height: auto">
        <!-- sidebar  -->
        <div class="sidebar">
            <?php include 'components/sidebar/sbr-halaman-pegawai.php' ?>
        </div>
        <div class="wrapper-navbar-content">
            <div class="navbar">
                <?php include 'components/navbar/nvb-halaman-pegawai.php' ?>
            </div>
            <div class="content">
                <?php include 'page/page-halaman-pegawai.php' ?>
            </div>
        </div>
    </div>
    <script src="js/sbr-halaman-pegawai.js"></script>
    <script src="js/page-halaman-pegawai.js"></script>
</body>

</html>