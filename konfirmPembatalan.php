<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css" />
    <link rel="stylesheet" href="dist/output.css" />
    <link rel="icon" type="image/x-icon" href="ico/dapnetwork.ico"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Konfirmasi Pembatalan</title>
</head>

<?php
require 'function/connection.php';
require 'function/pembatalan.php';
if(!isset($_GET['id_pemesanan'])) {
    header("Location: pembatalan.php");
    die();
}
if(isset($_POST['kembali'])) {
    echo "
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: 'Tidak jadi membatalkan pemesanan?',
                text: 'Silahkan lakukan pembatalan jika diperlukan sebelum tanggal instalasi yang anda inginkan',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Benar',
                cancelButtonText: 'Batal'
            }).then((result) => {
                window.location.href = 'index.php';
            });
        });
    </script>";
}
$id_pemesanan = isset($_GET['id_pemesanan']) ? $_GET['id_pemesanan'] : '';
$SQL = "SELECT * FROM tb_client 
        JOIN tb_pemesanan ON tb_pemesanan.id_client = tb_client.id_client 
        WHERE tb_pemesanan.id_pemesanan = ?";
        
$stmt = mysqli_prepare($connection_database, $SQL);
mysqli_stmt_bind_param($stmt, "s", $id_pemesanan);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Fetch the data
$row = mysqli_fetch_assoc($result);
$nama_client = $row['nama_client'];
$tanggal_pesan = $row['tanggal_pesan_instalasi'];
$tanggal_ingin_instalasi = $row['tanggal_instalasi'];
$tanggal_instalasi = date("d F Y", strtotime($tanggal_ingin_instalasi));
$id_client = $row['id_client'];

if(isset($_POST['submit'])) {
    if(empty($_POST['alasan'])) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Alasan pembatalan belum diisi!',
                    text: 'Alasan pembatalan harus diisi!',
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oke',
                });
            });
        </script>";
    } else {
        if(pembatalan($_POST) > 0) {
            echo "
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        title: 'Konfirmasi Pembatalan?',
                        text: 'Anda bisa melakukan pemesanan kembali dalam waktu 24 jam atau dengan menghubungi admin pada tombol hubungi di halaman beranda!',
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
                                title: 'Pembatalan Berhasil!',
                                text: 'Pembayaran anda akan kami kembalikan segera ke rekening anda dengan bukti pembayaran via WhatsApp!',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'index.php';
                                }
                            }); 
                        }
                    });
                });
            </script>";
        }
    }
}
?>

<body class="bg-gray-2">
    <div class="container w-full h-h-otomatis flex justify-center p-4">
        <div class="subcontainer w-full" style="width: 500px;">
            <div class="wrapper-card w-full h-h-otomatis p-4 bg-white rounded-3xl">
                <div class="header w-full flex justify-center items-center">
                    <h1 class="text-2xl font-poppins-800">Konfirmasi Pembatalan</h1>
                </div>
                <div class="body w-full mt-4">
                    <form action="" method="post">
                        <input type="hidden" name="tglpesan" value="<?= $tanggal_instalasi ?>">
                        <input type="hidden" name="idclient" value="<?= $id_client ?>">
                        <input type="hidden" name="idpemesanan" value="<?= $_GET['id_pemesanan'] ?>">
                        <div class="w-full flex flex-col gap-gap-10px">
                            <div class="input bg-bg-green-trans-1 p-4 rounded-md">
                                <div>
                                    <p class="text-normal font-poppins-500">ID Pemesanan Anda</p>
                                </div>
                                <div>
                                    <p class="text-normales font-poppins-500"><?= $_GET['id_pemesanan']; ?></p>
                                </div>
                            </div>
                            <div class="input bg-bg-green-trans-1 p-4 rounded-md">
                                <div>
                                    <p class="text-normal font-poppins-500">Nama anda</p>
                                </div>
                                <div>
                                    <p class="text-normales font-poppins-500"><?= $nama_client ?></p>
                                </div>
                            </div>
                            <div class="input bg-bg-green-trans-1 p-4 rounded-md">
                                <div>
                                    <p class="text-normal font-poppins-500">Tanggal instalasi anda</p>
                                </div>
                                <div>
                                    <p class="text-normales font-poppins-500"><?= $tanggal_instalasi ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="input w-full mt-2">
                            <div><label for="alasan" class="mb-2 text-normal font-poppins-500">Alasan pembatalan</label></div>
                            <div><textarea class="p-4 font-poppins-500 rounded-md bg-gray-2 w-full" name="alasan" id="alasan" cols="30" rows="5" placeholder="Masukkan alasan pembatalan"></textarea></div>
                        </div>
                        <div class="btn grid grid-cols-2 gap-gap-10px mt-6">
                            <button type="submit" name="kembali" class="w-full hover:bg-gray-2 bg-white text-normal p-4 rounded-md shadow-box-shadow-1">Kembali</button>
                            <button type="submit" name="submit" class="w-full hover:bg-red-1 bg-red-500 text-normal text-white p-4 rounded-md shadow-box-shadow-1">Konfirmasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>