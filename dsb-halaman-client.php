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
  <meta name="description" content="Halaman Client" />
  <meta name="keywords" content="Halaman Client" />
  <link rel="icon" type="image/x-icon" href="ico/dapnetwork.ico" />
  <link rel="stylesheet" href="css/all.css" />
  <link rel="stylesheet" href="css/page-halaman-client.css" />
  <link rel="stylesheet" href="css/card-daftaclient-penagihan.css"/>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <title>Dashboard - Halaman client | DAPNETWORK</title>
</head>
<body>
  <div class="overlay-popup"></div>
  <div><?php include 'components/popup/insert-data-client.php' ?></div>
  <div class="container" style="width: 100%; height: auto">
    <!-- sidebar  -->
    <div class="sidebar">
      <?php include 'components/sidebar/sbr-halaman-client.php' ?>
    </div>
    <div class="wrapper-navbar-content">
      <div class="navbar">
        <?php include 'components/navbar/nvb-halaman-client.php' ?>
      </div>
      <div class="content">
        <?php include 'page/page-halaman-client.php' ?>
      </div>
    </div>
  </div>
  <script src="js/sbr-halaman-client.js"></script>
  <script src="js/page-halaman-client.js"></script>
  <script src="js/card-penagihan.js"></script>
</body>

</html>