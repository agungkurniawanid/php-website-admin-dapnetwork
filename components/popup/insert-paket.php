<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<?php  
require 'function/insert-paket.php';
if(isset($_POST['tambah-paket'])) {
    if(!isset($_POST['harga'])) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'info',
                    title: 'Oops...',
                    text: 'Harga tidak boleh kosong!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            });
        </script>";
    } else {
        if(insertPaket($_POST) > 0) {
            echo "
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'success',
                        title: 'Paket ditambahkan!',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                });
            </script>";
        } else {
            echo "
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Paket gagal ditambahkan!',
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
    <div class="container-popup-insert-paket">
        <div class="header">
            <div>Tambah Paket</div>
            <div class="iconclose"><img src="svg/circle-xmark.svg" alt="close" id="btn-close-form-paket"></div>
        </div>
        <div class="body">
            <form action="" method="post">
                <div class="input">
                    <div><label for="jenispaket">Jenis Layanan</label></div>
                    <div>
                        <select name="jenislayanan" id="jenispaket">
                            <option value="50Mbps">50Mbps</option>
                            <option value="20Mbps">20Mbps</option>
                            <option value="10Mbps">10Mbps</option>
                            <option value="8Mbps">8Mbps</option>
                            <option value="5Mbps">5Mbps</option>
                        </select>
                    </div>
                </div>
                <div class="input">
                    <div><label for="harga">Harga</label></div>
                    <div><input type="number" name="harga" id="harga" placeholder="Masukkan harga"></div>
                </div>
                <div class="input">
                    <div><label for="deksripsi">Harga</label></div>
                    <div><textarea name="deskripsi" id="deskripsi" cols="30" rows="10">Masukkan deskripsi</textarea></div>
                </div>
                <div class="button">
                    <button type="submit" name="tambah-paket">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>