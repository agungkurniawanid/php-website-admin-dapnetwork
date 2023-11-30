<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<?php 
require 'function/connection.php';
require 'function/insert-produk.php';
if(isset($_POST['submit'])) {
    if(!isset($_POST['namaproduk'])) {
        echo "
      <script>
        document.addEventListener('DOMContentLoaded', function () {
          Swal.fire({
            icon: 'info',
            title: 'Oops...',
            text: 'Nama produk kosong!',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
          });
        });
      </script>";
    } else if (!isset($_POST['stokproduk'])) {
        echo "
      <script>
        document.addEventListener('DOMContentLoaded', function () {
          Swal.fire({
            icon: 'info',
            title: 'Oops...',
            text: 'Stok produk kosong!',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
          });
        });
      </script>";
    } else if (!isset($_POST['merekproduk'])){
        echo "
      <script>
        document.addEventListener('DOMContentLoaded', function () {
          Swal.fire({
            icon: 'info',
            title: 'Oops...',
            text: 'Merek produk kosong!',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
          });
        });
      </script>";
    } else if (!isset($_POST['hargaproduk'])){
        echo "
      <script>
        document.addEventListener('DOMContentLoaded', function () {
          Swal.fire({
            icon: 'info',
            title: 'Oops...',
            text: 'Harga produk kosong!',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
          });
        });
      </script>";
    } else {
        if(insertProduk($_POST) > 0) {
            echo "
      <script>
        document.addEventListener('DOMContentLoaded', function () {
          Swal.fire({
            icon: 'success',
            title: 'Horee!',
            text: 'Data Produk berhasil di tambahkan!',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
          });
        });
      </script>";
        }
    }
}
?>

<body>
    <div class="wrapper-insert-product">
        <div class="wip-juduldanclose">
            <div class="wip-judul">Tambah Product</div>
            <div class="wip-close"><img src="svg/x.svg" alt="close icon" id="wip-close"></div>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="input">
                <div class="input-foto">
                    <label for="foto">
                        <img src="svg/inbox-out 1.svg" alt="img" id="image-form-produk">
                    </label>
                </div>
                <div class="pembungkus-input-file">
                    <input type="file" name="fotoproduk" id="foto" onchange="changeImageFormProduk(this)">
                    <label for="foto" id="fotountukgambarproduct">Pilih Foto Product</label>
                </div>
            </div>
            <div class="input">
                <div><label for="nama">Nama Product</label></div>
                <div><input type="text" name="namaproduk" placeholder="Masukkan nama product"></div>
            </div>
            <div class="input">
                <div><label for="deskripsi produk">Deskripsi produk</label></div>
                <div><textarea name="deskripsiproduk" id="" cols="30" rows="3"></textarea></div>
            </div>
            <div class="input">
                <div><label for="stok">Stok produk</label></div>
                <div><input type="number" name="stokproduk" placeholder="Masukkan jumlah stok"></div>
            </div>
            <div class="input">
                <div><label for="merek">Merek produk</label></div>
                <div><input type="text" name="merekproduk" placeholder="Masukkan merek produk"></div>
            </div>
            <div class="input">
                <div><label for="kategori">Kategori produk</label></div>
                <div><select name="kategoriproduk" id="kategori">
                        <option value="Router">Router</option>
                        <option value="Converter">Converter</option>
                        <option value="Patch Core">Patch Core</option>
                        <option value="LAN">LAN</option>
                        <option value="Power Supply">Power Supply</option>
                        <option value="Switch Hub">Switch Hub</option>
                        <option value="Connector">Connector</option>
                        <option value="Splitter">Splitter</option>
                    </select></div>
            </div>
            <div class="input">
                <div><label for="harga">Harga produk</label></div>
                <div><input type="text" name="hargaproduk" placeholder="Masukkan harga produk"></div>
            </div>
            <div class="button">
                <button type="submit" name="submit">Tambah</button>
            </div>
        </form>
    </div>
</body>

</html>