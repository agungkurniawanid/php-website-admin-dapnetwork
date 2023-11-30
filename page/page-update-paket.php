<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/all.css" />
    <link rel="stylesheet" href="../css/page-halaman-paket.css" />
    <link rel="icon" type="image/x-icon" href="../ico/dapnetwork.ico" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Update Paket</title>
</head>

<?php 
require '../function/connection.php';
require '../function/update-paket.php';

$SELECT_PAKET = mysqli_query($connection_database, "SELECT * FROM tb_paket_layanan WHERE id_paket_layanan = '$_GET[id_paket_layanan]'");
$paket = mysqli_fetch_assoc($SELECT_PAKET);

if (isset($_POST['update'])) {
    if (UPDATEPAKET($_POST) > 0) {
        echo "
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Data paket layanan berhasil diubah!',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then((swipe) => {
                        window.location.href = '../dsb-paket-layanan.php';
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
                        text: 'Data paket layanan gagal diubah!',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                });
            </script>";
    }
}
?>

<body>
    <div class="container-page-update-paket">
        <div class="sub">
            <div class="logo-heading">
                <div class="logo">
                    <img onclick="window.location.href = '../dsb-paket-layanan.php';" src="../svg/arrow-small-right-blue.svg" alt="">
                </div>
                <div class="heading">Update Data Paket</div>
            </div>
            <div class="form">
                <form action="" method="post">
                    <input type="hidden" name="idpaketlayanan" id="idpaketlayanan" value="<?= $paket['id_paket_layanan'] ?>">
                    <div class="input">
                        <div><label for="jenispaketlayanan">Jenis Paket</label></div>
                        <div>
                            <select name="jenispaketlayanan" id="jenispaketlayanan">
                                <option value="5Mbps" <?= ($paket['jenis_paket_layanan'] == '5Mbps') ? 'selected' : '' ?>>5Mbps</option>
                                <option value="8Mbps" <?= ($paket['jenis_paket_layanan'] == '8Mbps') ? 'selected' : '' ?>>8Mbps</option>
                                <option value="10Mbps" <?= ($paket['jenis_paket_layanan'] == '10Mbps') ? 'selected' : '' ?>>10Mbps</option>
                                <option value="20Mbps" <?= ($paket['jenis_paket_layanan'] == '20Mbps') ? 'selected' : '' ?>>20Mbps</option>
                                <option value="50Mbps" <?= ($paket['jenis_paket_layanan'] == '50Mbps') ? 'selected' : '' ?>>50Mbps</option>
                            </select>
                        </div>
                    </div>
                    <div class="input">
                        <div><label for="harga">Harga Paket</label></div>
                        <div><input type="number" name="harga" id="harga" placeholder="Harga Paket" value="<?= $paket['harga'] ?>" /></div>
                    </div>
                    <div class="input">
                        <div><label for="deskripsipaket">Deskripsi Paket</label></div>
                        <div><textarea name="deskripsipaket" id="deskripsipaket" cols="30" rows="10"><?= $paket['deskripsi_paket_layanan'] ?></textarea></div>
                    </div>
                    <button class="btn-update-paket" type="submit" name="update">Update</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
