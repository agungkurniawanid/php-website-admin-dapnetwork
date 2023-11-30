<?php 
session_start();
if (!isset($_SESSION["loginmasuk"])) {
  header("Location: signin.php");
  exit;
} 
$foto_profile = $_SESSION['fotopegawai'];
$nama_user = $_SESSION['namapegawai'];
$status_user = $_SESSION['statuspegawai'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="author" content="Agung Kurniawan" />
    <meta name="description" content="Halaman Paket" />
    <meta name="keywords" content="Halaman Paket" />
    <link rel="stylesheet" href="css/all.css" />
    <link rel="icon" type="image/x-icon" href="ico/dapnetwork.ico" />
    <link rel="stylesheet" href="css/sbr-halaman-paket.css"/>
    <link rel="stylesheet" href="css/nvb-halaman-paket.css"/>
    <link rel="stylesheet" href="css/page-halaman-paket.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Paket Layanan - DAP Network</title>
</head>

<body>
    <div class="overlay-popup-insert-paket"></div>
    <div><?php include 'components/popup/insert-paket.php' ?></div>
    <div class="container" style="width: 100%; height: auto">
        <!-- sidebar  -->
        <div class="sidebar">
            <?php include 'components/sidebar/sbr-halaman-paket.php' ?>
        </div>
        <div class="wrapper-navbar-content">
            <div class="navbar">
                <?php include 'components/navbar/nvb-halaman-paket.php' ?>
            </div>
            <div class="content">
                <?php include 'page/page-halaman-paket.php' ?>
            </div>
        </div>
    </div>
    <script src="js/sbr-halaman-paket.js"></script>
    <script src="js/page-halaman-paket.js"></script>
</body>

</html>