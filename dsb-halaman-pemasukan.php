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
    <meta name="description" content="Halaman Pemasukan" />
    <meta name="keywords" content="Halaman Pemasukan" />
    <link rel="stylesheet" href="css/all.css" />
    <link rel="icon" type="image/x-icon" href="ico/dapnetwork.ico" />
    <link rel="stylesheet" href="css/all.css"/>
    <link rel="stylesheet" href="css/sbr-halaman-pemasukan.css"/>
    <link rel="stylesheet" href="css/nvb-halaman-pemasukan.css"/>
    <link rel="stylesheet" href="css/page-pemesanan.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Pemasukan - DAP Network</title>
</head>

<body>
    <div class="container" style="width: 100%; height: auto">
        <!-- sidebar  -->
        <div class="sidebar">
            <?php include 'components/sidebar/sbr-halaman-pemasukan.php' ?>
        </div>
        <div class="wrapper-navbar-content">
            <div class="navbar">
                <?php include 'components/navbar/nvb-halaman-pemasukan.php' ?>
            </div>
            <div class="content">
                <?php include 'page/page-pemasukan.php' ?>
            </div>
        </div>
    </div>
    <script src="js/sbr-halaman-pemasukan.js"></script>
    <script src="js/nvb-halaman-utama.js"></script>
    <script src="js/page-halaman-pemasukan.js"></script>
</body>

</html>