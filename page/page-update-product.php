<?php
session_start();
if(!isset($_SESSION["loginmasuk"])){
  header("location:../signin.php");
  exit;
} 
require '../function/connection.php';
require '../function/delete-product.php';
require '../function/updates-produk.php';

$GET_NAMA_PRODUK = $_GET['nama_product'];
$getNamaProduk = mysqli_query($connection_database, "SELECT * FROM tb_product where nama_product = '$GET_NAMA_PRODUK'");
$namaProduk = mysqli_fetch_assoc($getNamaProduk);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/page-update-produk.css" />
    <link rel="stylesheet" href="../css/all.css" />
    <link rel="icon" type="image/x-icon" href="../ico/dapnetwork.ico" />
    <link rel="stylesheet" href="../css/popup-update-product.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Update data product</title>
  </head>
  <body>
    <div class="succesDelete"></div>
    <div class="overlay-popup-update-product"></div>
    <?php include '../components/popup/update-product.php' ?>
    <div class="container-update-data-product">
      <div class="header">
        <div
          class="tombol-kembali"
          onclick="window.location.href='../dsb-halaman-product.php'"
        >
          <div><img src="../svg/arrow-left .svg" alt="btn kembali" /></div>
          <div>Kembali</div>
        </div>
        <div class="btn-update-delete">
          <div class="btn"><button id="btnUpdate">Update</button></div>
          <div class="btn"><button onclick="confirmDeleteProduct(document.getElementById('idproduk').value)">Delete</button></div>
        </div>
      </div>
      <div class="body">
        <div class="image">
          <div>
            <img
              src="../images/<?= $namaProduk['gambar_product'] ?>"
              alt="foto produk"
            />
          </div>
        </div>
        <div class="detail">
          <div class="nama-id-status">
            <div>
              <div class="nama"><?= $namaProduk['nama_product'] ?></div>
              <div class="id">ID : <?= $namaProduk['id_product'] ?></div>
            </div>
            <div class="sts-produk"><?= $namaProduk['status_product'] ?></div>
          </div>
          <div class="harga-produk">
            <div class="name">Harga</div>
            <div class="harga">Rp. <?= number_format($namaProduk['harga_product'], 0, ',', '.'); ?></div>
          </div>
          <div class="merek-produk">
            <div class="name">Merek : </div>
            <div class="merek"><?= $namaProduk['merek_product'] ?></div>
          </div>
          <div class="tanggal-ditambahkan">
            <div class="name">tanggal ditambahkan :</div>
            <div class="tgl"><?= date('j F Y', strtotime($namaProduk['tanggal_ditambahkan_product'])) ?></div>
          </div>
          <div class="kategori-produk">
            <div class="name">kategori : </div>
            <div class="kategori"><?= $namaProduk['kategori_product'] ?></div>
          </div>
          <div class="stok-produk">
            <div class="name">stok : </div>
            <div class="stok"><?= $namaProduk['stok_product'] ?> Produk</div>
          </div>
          <div class="deskripsi-produk">
            <div class="name">deskripsi : </div>
            <div class="deskripsi">
              <?= $namaProduk['deskripsi_product'] ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
     function confirmDeleteProduct(id) {
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '?id_product=' + id;
                }
            });
        }
    </script>
    <?php
    if (isset($_GET["id_product"])) {
        $id = $_GET["id_product"];
        $affected_rows = hapus_product($id);
        if ($affected_rows > 0) {
          echo "
              <script>
                  var successMessage = document.querySelector('.succesDelete');
                  successMessage.style.display = 'initial';
              </script>
          ";
          echo "
              <script>
                  Swal.fire({
                      icon: 'success',
                      title: 'Berhasil',
                      text: 'Data berhasil dihapus.',
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'OK'
                  }).then((result) => {
                      if (result.isConfirmed) {
                          window.location.href='../dsb-halaman-product.php';
                      }
                  });
              </script>
          ";
      }
    }
    ?>
    <script src="../js/popup-update-produk.js"></script>
  </body>
</html>
