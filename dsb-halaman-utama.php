<?php
session_start();
if (!isset($_SESSION["loginmasuk"])) {
  header("Location: signin.php");
  exit;
} 
$foto_profile = $_SESSION['fotopegawai'];
$nama_user = $_SESSION['namapegawai'];
$status_user = $_SESSION['statuspegawai'];
require 'function/connection.php';
?>
<!DOCTYPE html>
<html lang="id-ID">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="author" content="Agung Kurniawan" />
    <meta name="description" content="Halaman Dashboard" />
    <meta name="keywords" content="Halaman Dashboard" />
    <link rel="stylesheet" href="css/all.css" />
    <link rel="icon" type="image/x-icon" href="ico/dapnetwork.ico" />
    <title>Dashboard - Halaman utama | Dapnetwork</title>
  </head>
  <body>
    <div class="container">
      <!-- sidebar  -->
      <div class="wrapper-sidebar">
        <?php include 'components/sidebar/sbr-halaman-utama.php' ?>
      </div>
      <div class="wrapper-navbar-content">
        <div class="navbar">
          <?php include 'components/navbar/nvb-halaman-utama.php' ?>
        </div>
        <div class="content">
          <?php include 'page/page-halaman-utama.php' ?>
        </div>
      </div>
    </div>
  </body>
</html>
