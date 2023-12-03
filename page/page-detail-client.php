<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/all.css" />
    <link rel="stylesheet" href="../css/page-detail-client.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Detail Client</title>
    <style>
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            opacity: 0;
            visibility: hidden;
            transition: all .3s ease-in-out;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 50;
        }
    </style>
</head>

<?php
require '../function/connection.php';
require '../function/hapus-pembayaran.php';
require '../function/tambah-pembayaran.php';

// todo cek apakah sudah menerima id client? 
$_GET['id_client'] ? $_GET['id_client'] : header('Location: ../signin.php');

// todo select tb_client
$SELECT_TB_CLIENT = "SELECT * FROM tb_client WHERE id_client = '$_GET[id_client]'";
$SELECT_TB_CLIENT_RESULT = mysqli_query($connection_database, $SELECT_TB_CLIENT);
$SELECT_TB_CLIENT_ROW = mysqli_fetch_assoc($SELECT_TB_CLIENT_RESULT);

// todo generate tanggal
$tgl = $SELECT_TB_CLIENT_ROW['tanggal_masuk'];
$tgl = date('j F Y', strtotime($tgl));

// todo select tb_pemesanan 
$SELECT_TB_PEMESANAN = "SELECT * FROM tb_pemesanan JOIN tb_paket_layanan ON tb_pemesanan.id_paket_layanan = tb_paket_layanan.id_paket_layanan WHERE id_client = '$_GET[id_client]'";
$SELECT_TB_PEMESANAN_RESULT = mysqli_query($connection_database, $SELECT_TB_PEMESANAN);
$SELECT_TB_PEMESANAN_ROW = mysqli_fetch_assoc($SELECT_TB_PEMESANAN_RESULT);

// todo select tb_pembayaran
$SELECT_TB_PEMBAYARAN = "SELECT * FROM tb_pembayaran WHERE id_client = '$_GET[id_client]'";
$SELECT_TB_PEMBAYARAN_RESULT = mysqli_query($connection_database, $SELECT_TB_PEMBAYARAN);
$SELECT_TB_PEMBAYARAN_ROW = mysqli_fetch_assoc($SELECT_TB_PEMBAYARAN_RESULT);

// todo select tb_catatan_pembayaran
$SELECT_TB_CATATAN_PEMBAYARAN = "SELECT * FROM tb_catatan_pembayaran JOIN tb_paket_layanan ON tb_catatan_pembayaran.id_paket_layanan = tb_paket_layanan.id_paket_layanan WHERE id_client = '$_GET[id_client]'";
$SELECT_TB_CATATAN_PEMBAYARAN_RESULT = mysqli_query($connection_database, $SELECT_TB_CATATAN_PEMBAYARAN);
$SELECT_TB_CATATAN_PEMBAYARAN_ROW = mysqli_fetch_assoc($SELECT_TB_CATATAN_PEMBAYARAN_RESULT);

// todo fungsi insert pembayaran
if (isset($_POST['pembayaran'])) {
    if (tambahPembayaran($_POST) > 0) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Data pembayaran berhasil ditambahkan!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.reload();
                });
            });
        </script>";
    }
}

?>

<body>
    <div class="container">
        <div class="untuk-background">
            <button onclick="window.location.href='../dsb-halaman-client.php'">Kembali</button>
            <img src="https://i.imgur.com/PLY1Lp0.jpg" alt="okok">
        </div>
        <div class="untuk-profile">
            <div class="foto-dan-title">
                <div class="foto"><img src="../images/<?= $SELECT_TB_CLIENT_ROW['foto_client'] ?>" alt="327979180-720697956118615-8277811980532964440-n" alt=""></div>
                <div class="title">
                    <div class="name">
                        <h1><?= $SELECT_TB_CLIENT_ROW['nama_client'] ?></h1>
                        <div><button type="button" id="btn" class="btn"><img src="../svg/Paper.svg" alt=""> Catatan</button></div>
                    </div>
                    <div class="status">
                        <p><?= $SELECT_TB_CLIENT_ROW['status_client'] ?></p>
                    </div>
                    <div class="kelamin">
                        <img src="../svg/Arrow---Left-2.svg" alt="">
                        <p><?= $SELECT_TB_CLIENT_ROW['jenis_kelamin'] ?></p>
                    </div>
                </div>
            </div>
            <div class="id">
                <div>
                    <p>ID Client : &nbsp;</p>
                    <p><?= $SELECT_TB_CLIENT_ROW['id_client'] ?></p>
                </div>
            </div>
        </div>
        <div class="informasi-detail-client">
            <div class="informasi-kontak">
                <p>Informasi Kontak</p>
                <table>
                    <tr>
                        <th>Telephone</th>
                        <td><?= $SELECT_TB_CLIENT_ROW['nomor_telepon'] ?></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td><?= $SELECT_TB_CLIENT_ROW['alamat'] ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Masuk</th>
                        <td><?= $tgl ?></td>
                    </tr>
                    <tr>
                        <th>Jenis Rekening</th>
                        <td><?= $SELECT_TB_PEMESANAN_ROW['nama_bank'] ?></td>
                    </tr>
                    <tr>
                        <th>Nomor Rekening</th>
                        <td><?= $SELECT_TB_PEMESANAN_ROW['nomor_rekening'] ?></td>
                    </tr>
                </table>
            </div>
            <div class="informasi-transaksi">
                <p>Informasi Transaksi</p>
                <table>
                    <tr>
                        <th>Bulan <?= date('F') ?></th>
                        <td><?= $SELECT_TB_PEMBAYARAN_ROW['status_pembayaran'] ?></td>
                    </tr>
                    <tr>
                        <th>Metode Pembayaran</th>
                        <td><?= $SELECT_TB_PEMBAYARAN_ROW['metode_pembayaran'] ?></td>
                    </tr>
                    <tr>
                        <th>Nominal Pembayaran</th>
                        <td>Rp. <?= number_format($SELECT_TB_PEMBAYARAN_ROW['nominal_pembayaran'], 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <th>Kurang Pembayaran</th>
                        <td>Rp. <?= number_format($SELECT_TB_PEMBAYARAN_ROW['kurang_pembayaran'], 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <th>Kembalian Pembayaran</th>
                        <td>Rp. <?= number_format($SELECT_TB_PEMBAYARAN_ROW['kembalian_pembayaran'], 0, ',', '.') ?></td>
                    </tr>
                </table>
            </div>
            <div class="layanan-dipesan">
                <p>Layanan Dipesan</p>
                <table>
                    <tr>
                        <th>Paket Wifi</th>
                        <td><?= $SELECT_TB_PEMESANAN_ROW['jenis_paket_layanan'] ?></td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>Rp. <?= number_format($SELECT_TB_PEMESANAN_ROW['harga'], 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Pesan</th>
                        <td><?= date('j F Y', strtotime($SELECT_TB_PEMESANAN_ROW['tanggal_pesan_instalasi'])) ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Instalasi</th>
                        <td><?= date('j F Y', strtotime($SELECT_TB_PEMESANAN_ROW['tanggal_instalasi'])) ?></td>
                    </tr>
                    <tr>
                        <th>Status Instalasi</th>
                        <td><?= $SELECT_TB_PEMESANAN_ROW['status_pemesanan_instalasi'] ?></td>
                    </tr>
                    <tr>
                        <th>Update Pemesanan</th>
                        <td style="text-align: center; background-color: #FECB20;"><a href="page-update-pemesanan.php?pemesanan=<?= $SELECT_TB_PEMESANAN_ROW['id_pemesanan'] ?>&id_client=<?= $SELECT_TB_CLIENT_ROW['id_client'] ?>"><img style="width: 20px; cursor: pointer;" src="../svg/file-edit.svg" alt=""></a></td>
                        <!-- <td style="text-align: center; background-color: #FECB20;">
                            <form action="page-update-pemesanan.php" method="post" style="margin: 0; padding: 0;">
                                <input type="hidden" name="pemesanan" value="<?= $SELECT_TB_PEMESANAN_ROW['id_pemesanan'] ?>">
                                <button type="submit" style="border: none; background: none; cursor: pointer;">
                                    <img style="width: 20px;" src="../svg/file-edit.svg" alt="">
                                </button>
                            </form>
                        </td> -->
                    </tr>
                </table>
            </div>
        </div>
        <div class="informasi-transaksi-client">
            <div>
                <h1>Catatan Pembayaran</h1>
            </div>
            <div class="button-tambah-pembayaran">
                <div class="div"><button id="show-popup">Tambah Pembayaran</button></div>
            </div>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Harga Paket</th>
                            <th>Bukti Transfer</th>
                            <th>Tanggal & Bulan</th>
                            <th>Total Pembayaran</th>
                            <th>Metode Bayar</th>
                            <th>Nominal Bayar</th>
                            <th>Kurang Bayar</th>
                            <th>Kembalian Bayar</th>
                            <th>Status</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($SELECT_TB_CATATAN_PEMBAYARAN_RESULT as $item) : ?>
                            <tr>
                                <td><?= $no;
                                    $no++; ?></td>
                                <td><?= $item['id_catatan_pembayaran'] ?></td>
                                <td>Rp. <?= number_format($item['harga'], 0, ',', '.') ?></td>
                                <td><img src="../images/<?= $item['bukti_pembayaran'] ?>" alt=""></td>
                                <td><?= date('j F Y', strtotime($item['tanggal_pembayaran'])) ?></td>
                                <td>Rp. <?= number_format($item['total_pembayaran'], 0, ',', '.') ?></td>
                                <td><?= $item['metode_pembayaran'] ?></td>
                                <td>Rp. <?= number_format($item['nominal_pembayaran'], 0, ',', '.') ?></td>
                                <td>Rp. <?= number_format($item['kurang_pembayaran'], 0, ',', '.') ?></td>
                                <td>Rp. <?= number_format($item['kembalian_pembayaran'], 0, ',', '.') ?></td>
                                <td><?= $item['status_pembayaran'] ?></td>
                                <td><a href="page-update-pembayaran.php?id_catatan_pembayaran=<?= $item['id_catatan_pembayaran'] ?>"><img class="tbl-aksi-client" src="../svg/edit.svg" alt=""></a></td>
                                <td><a href="#" onclick="confirmDeletePembayaran('<?= $SELECT_TB_CLIENT_ROW['id_client'] ?>',<?= $item['id_catatan_pembayaran'] ?>)"><img class="tbl-aksi-client" src="../svg/trash.svg" alt=""></a></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- modal catatan  -->
        <div class="overlay-modal"></div>
        <div class="container-modal">
            <header class="header">
                <img id="close" class="close" src="../svg/close.png" alt="closepng">
            </header>
            <section class="body">
                <p><?= $SELECT_TB_PEMESANAN_ROW['catatan'] ?></p>
            </section>
        </div>
    </div>
    <script src="../js/popup-catatan.js"></script>
    <script>
        function confirmDeletePembayaran(idclient, id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data ini akan di hapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '?id_client=' + idclient + '&id_catatan_pembayaran=' + id;
                }
            })
        }
    </script>
    <?php
    if (isset($_GET['id_client']) && isset($_GET['id_catatan_pembayaran'])) {
        $id_client = $_GET['id_client'];
        $id_catatan_pembayaran = $_GET['id_catatan_pembayaran'];
        $affected_row = hapusPembayaran($id_client, $id_catatan_pembayaran);
        if ($affected_row > 0) {
            echo "
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Data pembayaran berhasil dihapus!',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'page-detail-client.php?id_client=" . $id_client . "';
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
                        text: 'Data pembayaran gagal dihapus!',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'page-detail-client.php?id_client=" . $id_client . "';
                    });
                });
            </script>";
        }
    }
    ?>

    <?php include '../components/popup/insert-pembayaran.php' ?>
    <div class="overlay"></div>
    <script>
        const buttonAction = document.getElementById('show-popup');
        const closeButtonClient = document.getElementById('closeButton');
        let boolShowPopupFormClient = false;
        let popupFormClient = document.querySelector('.form-container');

        buttonAction.addEventListener('click', function() {
            if (!boolShowPopupFormClient) {
                const showOverlayClient = document.querySelector('.overlay');
                if (showOverlayClient && popupFormClient) {
                    showOverlayClient.style.opacity = '1';
                    showOverlayClient.style.visibility = 'visible';
                    popupFormClient.style.top = '50%';
                    popupFormClient.style.opacity = '1';
                    popupFormClient.style.visibility = 'visible';

                    boolShowPopupFormClient = true;
                    showOverlayClient.addEventListener('click', function() {
                        hidePopupForm();
                    });

                    if (closeButtonClient) {
                        closeButtonClient.addEventListener('click', function() {
                            hidePopupForm();
                        });
                    }
                }
            }
        });

        function hidePopupForm() {
            const showOverlayClient = document.querySelector('.overlay');
            if (showOverlayClient && popupFormClient) {
                showOverlayClient.style.opacity = '0';
                showOverlayClient.style.visibility = 'hidden';
                popupFormClient.style.top = '-100%';
                popupFormClient.style.opacity = '0';
                popupFormClient.style.visibility = 'hidden';
                boolShowPopupFormClient = false;
            }
        }
    </script>

</body>

</html>