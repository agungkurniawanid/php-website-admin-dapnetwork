<?php
require 'function/connection.php';
if(isset($_POST['submit'])) {
    if(empty($_POST['idpemesanan'])) {
        echo "
              <script>
                document.addEventListener('DOMContentLoaded', function () {
                  Swal.fire({
                    title: 'Masukkan ID Pemesanan anda!',
                    text: 'ID Pemesanan telah anda download pada PDF setelah melakukan pembayaran pemesanan sebelumnya!',
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oke',
                  });
                });
              </script>";
    } else {
        $idpemesanan = $_POST['idpemesanan'];
        $cek = mysqli_query($connection_database, "SELECT * FROM tb_pemesanan WHERE id_pemesanan = '$idpemesanan'");
        if($cek->num_rows > 0) {
            header("Location: konfirmPembatalan.php?id_pemesanan=$idpemesanan");
        }
    }
} 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css" />
    <link rel="stylesheet" href="dist/output.css" />
    <link rel="icon" type="image/x-icon" href="ico/dapnetwork.ico"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Pembatalan - Dapnetwork</title>
</head>

<body class="bg-gray-2">
    <div class="container w-full flex justify-center h-h-otomatis p-4">
        <div class="subcontaner w-full" style="width: 500px;">
            <div class="wrapper-card bg-white rounded-3xl p-4">
                <div class="header flex justify-center mt-4">
                    <h1 class="text-2xl font-poppins-800 capitalize">Pembatalan</h1>
                </div>
                <div class="w-full p-2 rounded-md bg-red-trans-1 mt-4">
                    <p class="font-poppins-500 text-normal">Untuk melakukan pembatalan silahkan masukkan ID/Kode pemesanan yang sudah anda download dalam bentuk PDF setelah melakukan transaksi pemesanan sebelumnya.</p>
                </div>
                <div class="body w-full mt-4">
                    <form action="" method="post">
                        <div class="input w-full">
                            <div class="mb-2"><label class="text-normales font-poppins-500" for="idpemesanan">Masukkan ID/Kode Pemesanan</label></div>
                            <input class="mt-2 w-full border-none rounded-md bg-gray-2 p-2 text-normal font-poppins-500" type="text" name="idpemesanan" id="idpemesanan" placeholder="Masukkan ID Pemesanan!" autocomplete="new-password">
                        </div>
                        <div class="btn grid grid-cols-2 gap-gap-10px mt-4">
                            <a href="index.php" class="w-full text-normal text-center font-poppins-500 shadow-box-shadow-1 p-2 rounded-md hover:bg-gray-1">Kembali</a>
                            <button type="submit" name="submit" class="w-full p-2 text-normal font-poppins-500 text-white bg-blue-2 rounded-md hover:bg-blue-800">Selanjutnya</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>