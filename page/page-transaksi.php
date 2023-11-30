<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<?php
require 'function/connection.php';

// todo menampilkan client pemesanan
$CLIENT_PEMESANAN = mysqli_query(
    $connection_database,
    "SELECT * FROM tb_client JOIN tb_pemesanan ON tb_client.id_client = tb_pemesanan.id_client 
    WHERE tb_pemesanan.status_pemesanan_instalasi = 'Belum selesai' 
    AND MONTH(tanggal_pesan_instalasi) = MONTH(CURRENT_DATE()) 
    AND YEAR(tanggal_pesan_instalasi) = YEAR(CURRENT_DATE()) 
    ORDER BY tb_pemesanan.tanggal_pesan_instalasi DESC"
);

// todo menampilkan client pembatalan
$CLIENT_PEMBATALAN = mysqli_query(
    $connection_database,
    "SELECT * FROM tb_client JOIN tb_pembatalan ON tb_client.id_client = tb_pembatalan.id_client
    WHERE MONTH(tb_pembatalan.tanggal_pembatalan) = MONTH(CURRENT_DATE())
    AND YEAR(tb_pembatalan.tanggal_pembatalan) = YEAR(CURRENT_DATE())
    ORDER BY tb_pembatalan.tanggal_pembatalan DESC"
);

// todo menampilkan client pembayaran cash
$CLIENT_CASH = mysqli_query(
    $connection_database,
    "SELECT * FROM tb_client 
    JOIN tb_catatan_pembayaran ON tb_client.id_client = tb_catatan_pembayaran.id_client
    WHERE 
        MONTH(tb_catatan_pembayaran.tanggal_pembayaran) = MONTH(CURRENT_DATE()) AND
        YEAR(tb_catatan_pembayaran.tanggal_pembayaran) = YEAR(CURRENT_DATE()) AND
        tb_catatan_pembayaran.metode_pembayaran = 'Cash'
    ORDER BY tb_catatan_pembayaran.tanggal_pembayaran DESC"
);

// todo menampilkan client pembayaran transfer
$CLIENT_TRANSFER = mysqli_query(
    $connection_database,
    "SELECT * FROM tb_client 
    JOIN tb_catatan_pembayaran ON tb_client.id_client = tb_catatan_pembayaran.id_client
    WHERE 
        MONTH(tb_catatan_pembayaran.tanggal_pembayaran) = MONTH(CURRENT_DATE()) AND
        YEAR(tb_catatan_pembayaran.tanggal_pembayaran) = YEAR(CURRENT_DATE()) AND
        tb_catatan_pembayaran.metode_pembayaran = 'Transfer'
    ORDER BY tb_catatan_pembayaran.tanggal_pembayaran DESC"
);
?>

<body>
    <div class="container-page-transaksi">
        <div class="wrapper-btn-filter">
            <ul>
                <li><a href="#pemesanan">Pemesanan</a></li>
                <li><a href="#pembatalan">Pembatalan</a></li>
                <li><a href="#pembayaran">Pembayaran</a></li>
            </ul>
        </div>
        <div class="container-wrapper-card">
            <div class="wrapper-pemesanan">
                <h1 id="pemesanan">Pemesanan</h1>
                <p class="title-pemesanan">Daftar client yang melakukan pemesanan melalui media website dengan status pemesanan belum selesai</p>
                <div class="card-pemesanan">
                    <?php if (mysqli_num_rows($CLIENT_PEMESANAN) > 0) : ?>
                        <?php foreach ($CLIENT_PEMESANAN as $data) : ?>
                            <div class="cookie-card">
                                <span class="title"><?= $data['nama_client'] ?></span>
                                <p class="description"><?= $data['alamat'] ?></p>
                                <div class="actions">
                                    <button class="pref">
                                        <?= $data['tanggal_pesan_instalasi'] ?>
                                    </button>
                                    <button onclick="pemesanan('<?= $data['id_client'] ?>')" class="accept">
                                        Detail Client
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="cookie-card">
                            <span class="title">Tidak Ada Data</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="wrapper-pemesanan">
                <h1 id="pembatalan">Pembatalan</h1>
                <p class="title-pemesanan">Daftar client yang melakukan pembatalan pemesanan melaluai media website</p>
                <div class="card-pemesanan">
                    <?php if (mysqli_num_rows($CLIENT_PEMBATALAN) > 0) : ?>
                        <?php foreach ($CLIENT_PEMBATALAN as $data) : ?>
                            <div class="cookie-card">
                                <span class="title"><?= $data['nama_client'] ?></span>
                                <p class="description"><?= $data['alasan_pembatalan'] ?></p>
                                <div class="actions">
                                    <button class="pref">
                                        <?= $data['tanggal_pembatalan'] ?>
                                    </button>
                                    <button class="accept" onclick="pemesanan('<?= $data['id_client'] ?>')">
                                        Detail Client
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="cookie-card">
                            <span class="title">Tidak Ada Data</span>
                        </div>
                    <?php endif ?>
                </div>
            </div>

            <div class="wrapper-pemesanan">
                <h1 id="pembayaran">Pembayaran</h1>
                <div class="wrapper-pembayaran">
                    <div>
                        <div class="wrapper-title-search">
                            <p class="title-pemesanan">Daftar client yang melakukan pembaran CASH</p>
                            <form class="form">
                                <button>
                                    <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="search">
                                        <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                                <input class="input" oninput="cariPembayaran(this.value)" placeholder="Type your text" required="" type="text">
                                <button class="reset" type="reset">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                        <div class="card-pemesanan cardpembayaran">
                            <?php if (mysqli_num_rows($CLIENT_CASH) > 0) : ?>
                                <?php foreach ($CLIENT_CASH as $data) : ?>
                                    <div class="cookie-card">
                                        <span class="title"><?= $data['nama_client'] ?></span>
                                        <p class="description"><?= $data['alamat'] ?></p>
                                        <div class="actions">
                                            <button class="pref">
                                                <?= $data['tanggal_pembayaran'] ?>
                                            </button>
                                            <button class="accept" onclick="pemesanan('<?= $data['id_client'] ?>')">
                                                Detail Client
                                            </button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <div class="cookie-card">
                                    <span class="title">Tidak Ada Data</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div>
                        <div class="wrapper-title-search">
                            <p class="title-pemesanan">Daftar client yang melakukan pembaran TRANSFER</p>
                            <form class="form">
                                <button>
                                    <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="search">
                                        <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                                <input class="input" oninput="cariPembayaranTransfer(this.value)" placeholder="Type your text" required="" type="text">
                                <button class="reset" type="reset">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                        <div class="card-pemesanan cardpembayarantransfer">
                            <?php if (mysqli_num_rows($CLIENT_TRANSFER) > 0) : ?>
                                <?php foreach ($CLIENT_TRANSFER as $data) : ?>
                                    <div class="cookie-card">
                                        <span class="title"><?= $data['nama_client'] ?></span>
                                        <p class="description"><?= $data['alamat'] ?></p>
                                        <div class="actions">
                                            <button class="pref">
                                                <?= $data['tanggal_pembayaran'] ?>
                                            </button>
                                            <button class="accept" onclick="pemesanan('<?= $data['id_client'] ?>')">
                                                Detail Client
                                            </button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <div class="cookie-card">
                                    <span class="title">Tidak Ada Data</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function cariPembayaran(keyword) {
            $.ajax({
                type: 'POST',
                url: 'function/cari-pembayaran.php', // Sesuaikan dengan nama file yang tepat
                data: {
                    keyword: keyword
                },
                success: function(data) {
                    $('.cardpembayaran').html(data);
                }
            });
        }
        function cariPembayaranTransfer(keyword) {
            $.ajax({
                type: 'POST',
                url: 'function/cari-pembayaran-transfer.php', // Sesuaikan dengan nama file yang tepat
                data: {
                    keyword: keyword
                },
                success: function(data) {
                    $('.cardpembayarantransfer').html(data);
                }
            });
        }
        const pemesanan = (id) => {
            window.location.href = 'page/page-detail-client.php?id_client=' + id;
        }
    </script>
</body>

</html>