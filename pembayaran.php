<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css" />
    <link rel="stylesheet" href="dist/output.css" />
    <link rel="icon" type="image/x-icon" href="ico/dapnetwork.ico"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Pembayaran - DAP Network</title>
</head>

<?php 
require 'function/connection.php';
require 'function/pembayaran.php';

if(!isset($_GET['idpemesanan'])) {
    header("Location: ceklokasi.php");
    exit;
}
if (isset($_POST['submit'])) {
    if (pembayaran($_POST) > 0) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Konfirmasi Pembayaran?',
                    text: 'Anda bisa melakukan pembatalan sebelum tanggal instalasi yang anda inginkan',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Konfirmasi',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Pembayaran Berhasil!',
                            text: 'Terimakasih Telah melakukan pembayaran!',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'nota.php?idpemesanan=" . $_POST['idpemesanan'] . " &tanggalinstalasi=" . $_POST['tanggalinstalasi'] . "&namalengkap=" . $_POST['namalengkap'] . "';
                            }
                        }); 
                    }
                });
            });
        </script>";
    }
}
$GET_ID_PAKET = $_GET['idpaket'];
$SELECT_HARGA_PAKET = "SELECT * FROM tb_paket_layanan WHERE id_paket_layanan = '$GET_ID_PAKET'";
$QUERY_EXEC = mysqli_query($connection_database, $SELECT_HARGA_PAKET);
$RESULT = mysqli_fetch_assoc($QUERY_EXEC);
?>

<body class="bg-gray-2">
    <div id="container" class="w-full h-h-otomatis flex justify-center p-8">
        <div id="subcontainer" class="w-auto">
            <div id="btn-kembali"><img class="cursor-pointer w-10 bg-blue-2 p-2 rounded-full scale-x-mirror-1" src="ico/angle-small-right (1) 1.svg" alt="" onclick="window.location.href='index.php'"></div>
            <div id="wrappercard" class="mt-4 p-8 max-w-w-500px bg-white rounded-3xl">
                <div id="logodapnet" class="flex justify-center"><img class="w-28 object-contains" src="https://i.ibb.co/nQBNrRw/Group-2.png" alt=""></div>
                <div id="header" class="mt-2 flex justify-center">
                    <h1 class="text-3xl font-poppins-800">Pembayaran</h1>
                </div>
                <div id="body" class="mt-8">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="idpemesanan" value="<?= (isset($_GET['idpemesanan'])) ? $_GET['idpemesanan'] : '' ?>">
                        <input type="hidden" name="idclient" value="<?= (isset($_GET['idclient'])) ? $_GET['idclient'] : '' ?>">
                        <input type="hidden" name="totalpembayaran" value="<?= $RESULT['harga'] ?>">
                        <input type="hidden" name="idpaketlayanan" value="<?= (isset($_GET['idpaket'])) ? $_GET['idpaket'] : '' ?>">
                        <input type="hidden" name="tanggalinstalasi" value="<?= (isset($_GET['tanggalinstalasi'])) ? $_GET['tanggalinstalasi'] : '' ?>">
                        <input type="hidden" name="namalengkap" value="<?= (isset($_GET['namalengkap'])) ? $_GET['namalengkap'] : '' ?>">
                        <p class="text-normal w-full p-2 rounded-md text-red-1 bg-red-trans-1 font-poppins-500">Silahkan pilih salah satu rekening pembayaran, setelah melakukan pembayaran harap lakukan konfirmasi dengan mengirim foto bukti pembayaran</p>
                        <div class="e-wallet mt-4 flex-col flex gap-gap-10px">
                            <div class="flex gap-gap-10px items-center w-full bg-blue-2 p-2 rounded-2xl">
                                <img class="w-14" src="https://i.ibb.co/sQQ9TFn/BCA-Klik-Pay.png" alt="">
                                <p class="font-poppins-500 text-high text-white">3512965847</p>
                            </div>
                            <div class="flex gap-gap-10px items-center w-full bg-blue-2 p-2 rounded-2xl">
                                <img class="w-14" src="https://i.ibb.co/1MsBRhG/BRI-Direct-Debit.png" alt="">
                                <p class="font-poppins-500 text-high text-white">102349685746312</p>
                            </div>
                            <div class="flex gap-gap-10px items-center w-full bg-blue-2 p-2 rounded-2xl">
                                <img class="w-14" src="https://i.ibb.co/RPNDTf0/Mandiri-E-Cash.png" alt="">
                                <p class="font-poppins-500 text-high text-white">1023145758432</p>
                            </div>
                        </div>

                        <div class="input mt-6 font-poppins-500">
                            <div><label for="hargapaket">Harga Paket Wifi</label></div>
                            <div class="text-high text-red-600 font-poppins-800">Rp. <?= number_format($RESULT['harga'], 0, ',', '.') ?></div>
                        </div>

                        <div class="input w-full mt-4">
                            <div><label class="font-poppins-500 text-medium capitalize" for="foto">Foto Bukti Pembayaran</label></div>
                            <div>
                                <input class="opacity-0 invisible" type="file" id="foto" name="foto" onchange="changeImageFormPembayaran(this);">
                                <label for="foto" class="cursor-pointer"><img class="w-full max-w-w-500px max-h-h-500 object-contain" src="https://i.ibb.co/LhQ6Fr0/Upload-file-area.png" id="image-pembayaran-form" alt=""></label>
                            </div>
                        </div>

                        <div class="btn mt-6 w-full">
                            <button class="p-4 w-full rounded-md hover:bg-blue-800 bg-blue-2 font-poppins-500 text-normal text-white" type="submit" name="submit">Simpan Pembayaran</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    const changeImageFormPembayaran = (input) => {
      const fileInput = input.files[0];
      if (fileInput) {
        const reader = new FileReader();

        reader.onload = function (e) {
          const imageElement = document.getElementById("image-pembayaran-form");
          imageElement.src = e.target.result;
        };

        reader.readAsDataURL(fileInput);
      }
    }
  </script>
</body>

</html>