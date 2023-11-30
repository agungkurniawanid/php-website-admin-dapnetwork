<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<?php
if (isset($_POST['wup-update'])) {
    if (UpdateProduk($_POST) > 0) {
        echo "
              <script>
                  var successMessage = document.querySelector('.succesDelete');
                  successMessage.style.display = 'initial';
              </script>
          ";
        echo "
        <script>
          document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
              icon: 'success',
              title: 'Horee!',
              text: 'Berhasil di update',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'OK'
            }).then((result)=>{
                window.location.href='../dsb-halaman-product.php';
            })
          });
        </script>";
    } else {
        echo "
        <script>
          document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
              icon: 'info',
              title: 'Oops...',
              text: 'Gagal di update',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'OK'
            }).then((result)=>{
                window.location.href='../dsb-halaman-product.php';
            })
          });
        </script>";
    }
}
?>

<body>
    <div class="wup-wrapper-update-product">
        <div class="note">
            Anda bisa isi hanya satu atau lebih dari form dibawah ini untuk update data!
        </div>
        <!-- todo : input hidden  -->
        <div class="wup-juduldanclose">
            <div class="wup-judul">Tambah Product</div>
            <div class="wup-close"><img src="../svg/x.svg" alt="close icon" id="wup-close"></div>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" id="idproduk" name="wup-idproduct" value="<?= $namaProduk['id_product'] ?>">
            <input type="hidden" name="fotolamaproduk" value="../images/<?= $namaProduk['gambar_product'] ?>">
            <div class="wup-input">
                <div class="wup-input-foto">
                    <label for="wup-foto">
                        <img src="../images/<?= $namaProduk['gambar_product'] ?>" alt="img" id="wup-image-form-produk">
                    </label>
                </div>
                <div class="wup-pembungkus-input-file">
                    <input type="file" name="wup-fotoproduk" id="wup-foto" onchange="changeImageFormUpdateProduk(this)">
                    <label for="wup-foto" id="wup-fotountukgambarproduct">Pilih Foto Product</label>
                </div>
            </div>
            <div class="wup-input">
                <div><label for="wup-nama">Nama Product</label></div>
                <div><input type="text" name="wup-namaproduk" placeholder="Masukkan nama product"></div>
            </div>
            <div class="wup-input">
                <div><label for="wup-deskripsi">Deskripsi produk</label></div>
                <div><textarea name="wup-deskripsiproduk" id="" cols="30" rows="3"></textarea></div>
            </div>
            <div class="wup-input">
                <div><label for="wup-stok">Stok produk</label></div>
                <div><input type="number" name="wup-stokproduk" placeholder="Masukkan jumlah stok"></div>
            </div>
            <div class="wup-input">
                <div><label for="wup-merek">Merek produk</label></div>
                <div><input type="text" name="wup-merekproduk" placeholder="Masukkan merek produk"></div>
            </div>
            <div class="wup-input">
                <div><label for="wup-kategori">Kategori produk</label></div>
                <div>
                    <select name="wup-kategoriproduk" id="wup-kategori">
                        <option value="Router" <?php if (isset($namaProduk['kategori_product']) && $namaProduk['kategori_product'] === 'Router') echo 'selected'; ?>>Router</option>
                        <option value="Converter" <?php if (isset($namaProduk['kategori_product']) && $namaProduk['kategori_product'] === 'Converter') echo 'selected'; ?>>Converter</option>
                        <option value="Patch Core" <?php if (isset($namaProduk['kategori_product']) && $namaProduk['kategori_product'] === 'Patch Core') echo 'selected'; ?>>Patch Core</option>
                        <option value="LAN" <?php if (isset($namaProduk['kategori_product']) && $namaProduk['kategori_product'] === 'LAN') echo 'selected'; ?>>LAN</option>
                        <option value="Power Supply" <?php if (isset($namaProduk['kategori_product']) && $namaProduk['kategori_product'] === 'Power Supply') echo 'selected'; ?>>Power Supply</option>
                        <option value="Switch Hub" <?php if (isset($namaProduk['kategori_product']) && $namaProduk['kategori_product'] === 'Switch Hub') echo 'selected'; ?>>Switch Hub</option>
                        <option value="Connector" <?php if (isset($namaProduk['kategori_product']) && $namaProduk['kategori_product'] === 'Connector') echo 'selected'; ?>>Connector</option>
                        <option value="Splitter" <?php if (isset($namaProduk['kategori_product']) && $namaProduk['kategori_product'] === 'Splitter') echo 'selected'; ?>>Splitter</option>
                    </select>
                </div>

            </div>
            <div class="wup-input">
                <div><label for="wup-harga">Harga produk</label></div>
                <div><input type="text" name="wup-hargaproduk" placeholder="Masukkan harga produk"></div>
            </div>
            <div class="wup-input">
                <div><label for="wup-status">Status Produk</label></div>
                <div>
                    <select name="wup-statusproduk" id="wup-status">
                        <option value="Tersedia">Tersedia</option>
                        <option value="Habis">Habis</option>
                    </select>
                </div>
            </div>
            <div class="wup-button">
                <button type="submit" name="wup-update">Update</button>
            </div>
        </form>
    </div>
</body>

</html>