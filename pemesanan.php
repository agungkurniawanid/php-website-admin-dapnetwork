<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css" />
    <link rel="stylesheet" href="dist/output.css" />
    <link rel="icon" type="image/x-icon" href="ico/dapnetwork.ico"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Pemesanan - DAP Network</title>
</head>

<?php
require 'function/connection.php';
require 'function/pemesanan.php';
$SELECT_PAKET_LAYANAN  = mysqli_query($connection_database, "SELECT * FROM tb_paket_layanan");
$RESULT_PAKET_LAYANAN = mysqli_fetch_all($SELECT_PAKET_LAYANAN, MYSQLI_ASSOC);

$SELECT_ID_CLIENT = mysqli_query($connection_database, "SELECT * FROM tb_client WHERE nama_client = '{$_GET['namalengkap']}'");
$RESULT_ID_CLIENT = mysqli_fetch_all($SELECT_ID_CLIENT, MYSQLI_ASSOC);

if(!isset($_GET['namalengkap'])) {
    header("Location: registrasi.php");
    exit;
}

// todo generate id pemesanan 
function GenerateIDPemesenan()
{
    global $connection_database;
    $prefix = 'DAPPEMESANAN';
    $is_unique = false;
    while (!$is_unique) {
        $randomIDNumbers = mt_rand(10000000, 99999999);
        $id_client = $prefix . $randomIDNumbers;
        $result = mysqli_query($connection_database, "SELECT id_pemesanan FROM tb_pemesanan WHERE id_pemesanan = '$id_client'");
        if (!mysqli_fetch_assoc($result)) {
            $is_unique = true;
        }
    }
    return $id_client;
}

if (isset($_POST['submit'])) {
    
    if(empty($_POST['rekening'])) {
        echo "
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Rekening tidak boleh kosong!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              });
            });
          </script>";
    } else {
        if(pemesanan($_POST) > 0) {
            echo "
              <script>
                document.addEventListener('DOMContentLoaded', function () {
                  Swal.fire({
                    title: 'Yakin untuk pemesenan ini?',
                    text: 'Setelah menekan OK anda bisa lakukan pembayaran online maupun cash',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, saya yakin!'
                  }).then((result) => {
                    if(result.isConfirmed) {
                        Swal.fire({
                            title: 'Pemesanan Berhasil, Lanjutkan pembayaran Online?',
                            text: 'Anda bisa melakukan pembayaran online atau cash, jika online silahkan tekan pembayaran!',
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Pembayaran Online',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href='pembayaran.php?idclient=" . $_POST['idclient'] . "&idpemesanan=" . $_POST['idpemesanan'] . "&idpaket=" . $_POST['paket'] . " &tanggalinstalasi=" . $_POST['tanggalinstalasi'] . "&namalengkap=" . $_GET['namalengkap'] . "';
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
    <div id="container" class="w-full h-h-otomati flex justify-center p-8">
        <div id="subcontainer" class="w-auto">
            <div id="btn-kembali"><img class="cursor-pointer w-10 bg-blue-2 p-2 rounded-full scale-x-mirror-1" src="ico/angle-small-right (1) 1.svg" alt="" onclick="window.location.href='registrasi.php'"></div>
            <div id="wrappercard" class="mt-4 p-8 bg-white rounded-3xl">
                <div id="logodapnet" class="w-full flex justify-center"><img class="w-28" src="https://i.ibb.co/nQBNrRw/Group-2.png" alt=""></div>
                <div id="header" class="mt-2 flex justify-center">
                    <h1 class="text-3xl font-poppins-800">Pemesanan Layanan</h1>
                </div>
                <div id="body" class="mt-4">
                    <form action="" method="post">
                        <input type="hidden" name="idpemesanan" value="<?= GenerateIDPemesenan(); ?>">
                        <input type="hidden" name="idclient" value="<?php echo $RESULT_ID_CLIENT[0]['id_client']; ?>">
                        <div class="input w-full mt-2">
                            <div><label for="namapemesan" class="text-medium font-poppins-500">Nama Pemesan</label></div>
                            <div><input name="nama-lengkap" class="text-normal border-none w-full checked:outline-none p-3 bg-gray-1 rounded-md" type="text" value="<?php echo isset($_GET['namalengkap']) ? $_GET['namalengkap'] : 'Nama Kosong'; ?>" readonly></div>
                        </div>
                        <div class="input w-full mt-2">
                            <div><label for="bank"  class="text-medium font-poppins-500">Nama Bank</label></div>
                            <select name="bank" id="bank" class="w-full p-3 bg-gray-1 rounded-md">
                                <option value="BCA">BCA</option>
                                <option value="MANDIRI">MANDIRI</option>
                                <option value="BRI">BRI</option>
                            </select>
                        </div>
                        <div class="input w-full mt-2">
                            <div><label class="text-medium font-poppins-500" for="rekening">Nomor Rekening Anda</label></div>
                            <div><input class="text-normal border-none w-full checked:outline-none p-3 bg-gray-1 rounded-md" type="text" name="rekening" placeholder="Masukkan nomor rekening"></div>
                        </div>
                        <div class="input w-full mt-2">
                            <div><label class="text-medium font-poppins-500" for="instalasi">Masukkan Tanggal ingin instalasi</label></div>
                            <div><input class="text-normal border-none w-full checked:outline-none p-3 bg-gray-1 rounded-md" type="date" name="tanggalinstalasi"></div>
                        </div>
                        <div class="input w-full mt-2">
                            <div><label class="text-medium font-poppins-500" for="catatan">Pesan anda</label></div>
                            <div><textarea class="text-normal border-none w-full checked:outline-none p-3 bg-gray-1 rounded-md" name="catatan" id="catatan" cols="30" rows="5" placeholder="Contoh : pasang wifi didepan TV"></textarea></div>
                        </div>
                        <div class="input mt-2 w-full">
                            <div><label class="text-medium font-poppins-500" for="paket">Pilih paket layanan</label></div>
                            <div>
                                <select class="text-normal w-full p-4 bg-gray-1 rounded-md" name="paket" id="paket">
                                    <?php foreach ($RESULT_PAKET_LAYANAN as $key => $value) : ?>
                                        <option value="<?= $value['id_paket_layanan'] ?>"><?= $value['jenis_paket_layanan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="btn w-full mt-8">
                            <button class="w-full bg-blue-2 text-white p-4 rounded-md font-poppins-500 hover:bg-blue-800" type="submit" name="submit">Lakukan Pemesanan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>