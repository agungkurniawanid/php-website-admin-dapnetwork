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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css" />
    <link rel="stylesheet" href="css/sbr-halaman-pengeluaran.css"/>
    <link rel="stylesheet" href="css/nvb-halaman-pengeluaran.css"/>
    <link rel="stylesheet" href="css/page-pengeluaran.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Pengeluaran - Dapnetwork</title>
</head>

<body>
    <div class="container" style="width: 100%; height: auto">
        <!-- sidebar  -->
        <div class="sidebar">
            <?php include 'components/sidebar/sbr-halaman-pengeluaran.php' ?>
        </div>
        <div class="wrapper-navbar-content">
            <div class="navbar">
                <?php include 'components/navbar/nvb-halaman-pengeluaran.php' ?>
            </div>
            <div class="content">
                <?php include 'page/page-pengeluaran.php' ?>
            </div>
        </div>
    </div>
    <script src="js/sbr-halaman-pengeluaran.js"></script>
    <script src="js/nvb-halaman-utama.js"></script>
    <script src="js/page-halaman-pengeluaran.js"></script>
</body>

</html>