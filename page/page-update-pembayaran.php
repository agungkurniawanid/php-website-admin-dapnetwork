<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/all.css" />
    <link rel="stylesheet" href="../dist/output.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Update</title>
</head>
<?php
require '../function/connection.php';
require '../function/update-pembayaran.php';

// todo periksa apakah id sudah didapatkan jika belum alikan ke login 
$_GET['id_catatan_pembayaran'] ? $_GET['id_catatan_pembayaran'] : header('Location: ../signin.php');

// todo ambil id dari catatan pembayaran 
$ID = $_GET['id_catatan_pembayaran'];

// todo select tb_catatan_pembayaran 
$SELECT_TB_CATATAN_PEMBAYARAN = "SELECT * FROM tb_catatan_pembayaran JOIN tb_paket_layanan ON tb_catatan_pembayaran.id_paket_layanan = tb_paket_layanan.id_paket_layanan WHERE id_catatan_pembayaran = '$ID'";
$SELECT_TB_CATATAN_PEMBAYARAN_RESULT = mysqli_query($connection_database, $SELECT_TB_CATATAN_PEMBAYARAN);
$SELECT_TB_CATATAN_PEMBAYARAN_ROW = mysqli_fetch_assoc($SELECT_TB_CATATAN_PEMBAYARAN_RESULT);

// todo fungsi update 
if (isset($_POST['submit'])) {
    if (updatePembayaran($_POST) > 0) {
        echo "
              <script>
                document.addEventListener('DOMContentLoaded', function () {
                  Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Data pembayaran berhasil diubah!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                  }).then((swipe)=>{
                    window.location.href = '../page/page-detail-client.php?id_client=$SELECT_TB_CATATAN_PEMBAYARAN_ROW[id_client]';
                  })
                });
              </script>";
    } else {
        echo "
              <script>
                document.addEventListener('DOMContentLoaded', function () {
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Data pembayaran gagal diubah!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                  }).then((swipe)=>{
                    window.location.href = '../page/page-detail-client.php?id_client=$SELECT_TB_CATATAN_PEMBAYARAN_ROW[id_client]';
                  })
                });
              </script>";
    }
}
?>

<body class="bg-[#000000] text-white">
    <div class="container w-full flex justify-center p-4">
        <div class="subcontainer w-[350px]">
            <div onclick="window.history.back()" class="close flex items-center gap-[5px] cursor-pointer hover:bg-blue-2 rounded-md w-fit"><img class="w-8" src="../svg/cross-small 1.svg" alt="close"> Kembali</div>
            <div class="wrapper-input w-full">
                <form action="" method="post" class="w-full" enctype="multipart/form-data">
                    <div class="input w-full mt-4">
                        <div class="mb-2"><label for="id">Nomor ID</label></div>
                        <div><input class="text-black w-full p-4 text-normal rounded-md focus:outline-blue-700" type="text" name="id" placeholder="ID" value="<?= $ID ?>"></div>
                    </div>
                    <div class="input w-full mt-4">
                        <div class="mb-2"><label for="hargapaket">Harga Paket</label></div>
                        <div><input class="w-full p-4 text-normal rounded-md focus:outline-blue-700 text-black" value="<?= $SELECT_TB_CATATAN_PEMBAYARAN_ROW['harga'] ?>" type="text" name="hargapaket" placeholder="Harga Paket"></div>
                    </div>
                    <div class="input w-full mt-4">
                        <input type="hidden" name="buktilama" value="<?= $SELECT_TB_CATATAN_PEMBAYARAN_ROW['bukti_pembayaran'] ?>">
                        <div class="mb-2"><label for="bukti">Bukti Transfer</label></div>
                        <div class="">
                            <label><input value="<?= $SELECT_TB_CATATAN_PEMBAYARAN_ROW['bukti_pembayaran'] ?>" class="opacity-0 invisible" onchange="changeImageHalamanUpdatePembayaran(this)" type="file" name="bukti" id="bukti">
                                <label for="bukti"></label><img id="img" class="cursor-pointer w-full rounded-md h-[300px] object-cover" src="../images/<?= $SELECT_TB_CATATAN_PEMBAYARAN_ROW['bukti_pembayaran'] ?>" alt=""></label>
                        </div>
                        <label for="bukti" class="w-full"><button class="w-full p-4 text-normal mt-4 rounded-md cursor-pointer bg-[#fecb20]">Ganti Foto</button></label>
                    </div>
            </div>
            <div class="input w-full mt-4">
                <div class="mb-2"><label for="tanggal">Tanggal & Bulan</label></div>
                <div><input value="<?= $SELECT_TB_CATATAN_PEMBAYARAN_ROW['tanggal_pembayaran'] ?>" class="text-black text-normal w-full p-4 rounded-md focus:outline-blue-700" type="date" name="tanggal" placeholder="Tanggal & Bulan"></div>
            </div>
            <div class="input w-full mt-4">
                <div class="mb-2"><label for="totalpembayaran">Total Pembayaran</label></div>
                <div><input value="<?= $SELECT_TB_CATATAN_PEMBAYARAN_ROW['total_pembayaran'] ?>" class="text-black w-full p-4 text-normal rounded-md focus:outline-blue-700" type="text" name="totalpembayaran" placeholder="Total Pembayaran"></div>
            </div>
            <div class="input w-full mt-2">
                <div class="mb-2"><label for="metodebayar">Metode Bayar</label></div>
                <div>
                    <select class="w-full p-4 rounded-md focus:outline-blue-700 text-black text-normal" name="metodebayar" id="metodebayar">
                        <option value="Cash" <?php if ($SELECT_TB_CATATAN_PEMBAYARAN_ROW['metode_pembayaran'] == 'Cash') echo 'selected' ?>>Cash</option>
                        <option value="Transfer" <?php if($SELECT_TB_CATATAN_PEMBAYARAN_ROW['metode_pembayaran'] == 'Transfer') echo 'selected' ?>>Transfer</option>
                    </select>
                </div>
            </div>
            <div class="input w-full mt-4">
                <div class="mb-2"><label for="nominalbayar">Nominal Bayar</label></div>
                <div><input value="<?= $SELECT_TB_CATATAN_PEMBAYARAN_ROW['nominal_pembayaran'] ?>" class="w-full p-4 text-black text-normal rounded-md focus:outline-blue-700" type="text" name="nominalbayar" placeholder="Nominal Bayar"></div>
            </div>
            <div class="input w-full mt-4">
                <div class="mb-2"><label for="kurangbayar">Kurang Bayar</label></div>
                <div><input value="<?= $SELECT_TB_CATATAN_PEMBAYARAN_ROW['kurang_pembayaran'] ?>" class="text-black w-full p-4 text-normal rounded-md focus:outline-blue-700" type="text" name="kurangbayar" placeholder="Kurang Bayar"></div>
            </div>
            <div class="input w-full mt-4">
                <div class="mb-2"><label for="kembalianbayar">Kembalian Bayar</label></div>
                <div><input value="<?= $SELECT_TB_CATATAN_PEMBAYARAN_ROW['kembalian_pembayaran'] ?>" class="text-black w-full p-4 text-normal rounded-md focus:outline-blue-700" type="text" name="kembalianbayar" placeholder="Kembalian Bayar"></div>
            </div>
            <div class="input w-full mt-4">
                <div class="mb-2"><label for="status">Status</label></div>
                <div class="w-full">
                    <select class="p-4 text-normal rounded-md w-full text-black focus:outline-blue-700" name="status" id="status">
                        <option value="Lunas" <?php if ($SELECT_TB_CATATAN_PEMBAYARAN_ROW['status_pembayaran'] == 'Lunas') echo 'selected' ?>>Lunas</option>
                        <option value="Belum Lunas" <?php if($SELECT_TB_CATATAN_PEMBAYARAN_ROW['status_pembayaran'] == 'Belum Lunas') echo 'selected' ?>Belum lunas</option>
                        <option value="Bayar Double" <?php if($SELECT_TB_CATATAN_PEMBAYARAN_ROW['status_pembayaran'] == 'Bayar Double') echo 'selected' ?>>Bayar Double</option>
                        <option value="Dibatalkan" <?php if($SELECT_TB_CATATAN_PEMBAYARAN_ROW['status_pembayaran'] == 'Dibatalkan') echo 'selected' ?>>Dibatalkan</option>
                    </select>
                </div>
            </div>
            <div class="btn w-full">
                <button class="w-full p-4 text-normal mt-4 rounded-md bg-blue-2" type="submit" name="submit">Simpan Edit</button>
            </div>
            </form>
        </div>
    </div>
    </div>
    <script src="../js/page-update-pembayaran.js"></script>
</body>

</html>