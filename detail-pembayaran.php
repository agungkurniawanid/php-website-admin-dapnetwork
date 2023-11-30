<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css" />
    <link rel="icon" type="image/png" href="ico/dapnetwork.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/detail-pembayaran.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Detail Pembayaran</title>
    <style>
        body {
            width: 100%;
            height: 100%;
            padding: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<?php
require 'function/connection.php';
require 'function/bayar-online.php';

$PEMBAYARAN = $_GET['pembayaran'];

if(!isset($_GET['pembayaran'])) {
    header("Location: bayar-online.php");
    exit;
}

$SQL_TB_CLIENT = "SELECT * FROM tb_client WHERE nomor_telepon = '$PEMBAYARAN'";
$QUERY_TB_CLIENT = mysqli_query($connection_database, $SQL_TB_CLIENT);
$DATA_TB_CLIENT = mysqli_fetch_assoc($QUERY_TB_CLIENT);

$SQL1 = "SELECT * FROM tb_client JOIN tb_catatan_pembayaran ON tb_client.id_client = tb_catatan_pembayaran.id_client 
JOIN tb_pemesanan ON tb_client.id_client = tb_pemesanan.id_client
JOIN tb_paket_layanan ON tb_paket_layanan.id_paket_layanan = tb_pemesanan.id_paket_layanan
WHERE tb_client.id_client = '$DATA_TB_CLIENT[id_client]'";
$QUERY1 = mysqli_query($connection_database, $SQL1);
$DATA1 = mysqli_fetch_assoc($QUERY1);

$SQL2 = "SELECT * FROM tb_client JOIN tb_catatan_pembayaran
        ON tb_client.id_client = tb_catatan_pembayaran.id_client 
        WHERE tb_client.id_client = '{$DATA_TB_CLIENT['id_client']}'
        AND MONTH(tb_catatan_pembayaran.tanggal_pembayaran) = MONTH(CURDATE() - INTERVAL 1 MONTH)
        AND YEAR(tb_catatan_pembayaran.tanggal_pembayaran) = YEAR(CURDATE())";
$QUERY2 = mysqli_query($connection_database, $SQL2);
$DATA2 = mysqli_fetch_assoc($QUERY2);

$ID_CLIENT = $DATA_TB_CLIENT['id_client'];
$SQL3 = "SELECT 
            tb_pemesanan.id_pemesanan,
            tb_paket_layanan.id_paket_layanan,
            tb_paket_layanan.jenis_paket_layanan,
            tb_paket_layanan.harga,
            tb_catatan_pembayaran.status_pembayaran,
            tb_catatan_pembayaran.id_pembayaran,
            tb_catatan_pembayaran.kurang_pembayaran
        FROM 
            tb_pemesanan
        JOIN 
            tb_paket_layanan ON tb_pemesanan.id_paket_layanan = tb_paket_layanan.id_paket_layanan
        JOIN 
            tb_catatan_pembayaran ON tb_catatan_pembayaran.id_pemesanan = tb_pemesanan.id_pemesanan
        WHERE 
            tb_pemesanan.id_client = '$ID_CLIENT'
            AND MONTH(tb_catatan_pembayaran.tanggal_pembayaran) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH)
            AND YEAR(tb_catatan_pembayaran.tanggal_pembayaran) = YEAR(CURRENT_DATE())";
$QUERY3 = mysqli_query($connection_database, $SQL3);
$TOTAL_PEMBAYARAN = 0;
while ($ROW = mysqli_fetch_assoc($QUERY3)) {
    // Pengecekan sebelum mengakses elemen array
    $harga = isset($ROW['harga']) ? $ROW['harga'] : 0;
    $kurang_pembayaran = isset($ROW['kurang_pembayaran']) ? $ROW['kurang_pembayaran'] : 0;

    if ($ROW['status_pembayaran'] == 'Bayar Double') {
        // Jika status pembayaran Bayar Double
        $TOTAL_PEMBAYARAN += $harga * 2;
    } elseif ($ROW['status_pembayaran'] == 'Belum Lunas' && $kurang_pembayaran > 0) {
        // Jika status pembayaran Belum Lunas dan ada kurang bayar
        $TOTAL_PEMBAYARAN += ($harga + $kurang_pembayaran);
    } elseif ($ROW['status_pembayaran'] == 'Belum Lunas') {
        // Jika status pembayaran Belum Lunas tanpa kurang bayar
        $TOTAL_PEMBAYARAN += $harga;
    } else if ($ROW['status_pembayaran'] == 'Bayar Double' && $kurang_pembayaran > 0) {
        $TOTAL_PEMBAYARAN += ($harga * 2 + $kurang_pembayaran);
    } else {
        // Jika tidak memenuhi kondisi di atas, normal tampilkan harga paket layanan
        $TOTAL_PEMBAYARAN += $harga;
    }
}

if (isset($_POST['submit'])) {
    $AFFECTED = bayarOnline($_POST);
    if ($AFFECTED) {
        echo "<script>alert('Pembayaran Tagihan Berhasil')</script>";
        echo "<script>window.location.href='nota-bayar-bulanan.php?pembayaran=" . $DATA1['id_pembayaran'] . "'</script>";
    }
}
?>

<body>
    <input type="hidden" value="<?= $DATA_TB_CLIENT['id_client'] ?>">
    <div class="container">
        <div class="component-1">
            <div class="foto"><img src="images/default.png" alt=""></div>
            <div class="data-client">
                <div class="nama">
                    <p><?= $DATA_TB_CLIENT['nama_client'] ?></p>
                </div>
                <div class="email">
                    <p><?= $_GET['pembayaran'] ?></p>
                </div>
                <div class="alamat">
                    <p><?= $DATA_TB_CLIENT['alamat'] ?></p>
                </div>
            </div>
        </div>
        <div class="component-2">
            <p>BANK & Rekening</p>
            <table>
                <tr>
                    <th>BANK</th>
                    <td><?= $DATA1['nama_bank'] ?></td>
                </tr>
                <tr>
                    <th>Nomor Rekening</th>
                    <td><?= $DATA1['nomor_rekening'] ?></td>
                </tr>
            </table>
        </div>
        <div class="component-3">
            <p>Paket Dipesan</p>
            <table>
                <tr>
                    <th>Paket Internet</th>
                    <td><?= $DATA1['jenis_paket_layanan'] ?></td>
                </tr>
                <tr>
                    <th>Harga Paket</th>
                    <td>Rp. <?= number_format($DATA1['harga'], 0, ',', '.') ?></td>
                </tr>
            </table>
        </div>
        <div class="component-4">
            <p>Pembayaran Bulan Lalu - <?= date('F', strtotime('-1 month')) ?></p>
            <table>
                <tr>
                    <th>Tanggal Pembayaran</th>
                    <td><?= date('d M Y', strtotime($DATA2['tanggal_pembayaran'])) ?></td>
                </tr>
                <tr>
                    <th>Metode Pembayaran</th>
                    <td><?= $DATA2['metode_pembayaran'] ?></td>
                </tr>
                <tr>
                    <th>Nominal Pembayaran</th>
                    <td>Rp. <?= number_format($DATA2['nominal_pembayaran'], 0, ',', '.') ?></td>
                </tr>
                <tr>
                    <th>Kurang Pembayaran</th>
                    <td>Rp. <?= number_format($DATA2['kurang_pembayaran'], 0, ',', '.') ?></td>
                </tr>
                <tr>
                    <th>Kembalian Pembayaran</th>
                    <td>Rp. <?= number_format($DATA2['kembalian_pembayaran'], 0, ',', '.') ?></td>
                </tr>
                <tr>
                    <th>Total Pembayaran</th>
                    <td>Rp. <?= number_format($DATA2['total_pembayaran'], 0, ',', '.') ?></td>
                </tr>
                <tr>
                    <th>Status Pembayaran</th>
                    <td><?= $DATA2['status_pembayaran'] ?></td>
                </tr>
            </table>
        </div>
        <div class="component-5">
            <p>Harus Dibayar Bulan ini - <?= date('F') ?></p>
            <p>Rp. <?= number_format($TOTAL_PEMBAYARAN, 0, ',', '.') ?></p>
            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Bayar</button>
        </div>
    </div>

    <!-- MODAL  -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pembayaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="wrapper-card-norek">
                        <div class="card-norek">
                            <img src="https://i.ibb.co/sQQ9TFn/BCA-Klik-Pay.png" alt="">
                            <p class="font-poppins-500 text-high text-white">3512965847</p>
                        </div>
                        <div class="card-norek">
                            <img src="https://i.ibb.co/1MsBRhG/BRI-Direct-Debit.png" alt="">
                            <p class="font-poppins-500 text-high text-white">102349685746312</p>
                        </div>
                        <div class="card-norek">
                            <img src="https://i.ibb.co/RPNDTf0/Mandiri-E-Cash.png" alt="">
                            <p class="font-poppins-500 text-high text-white">1023145758432</p>
                        </div>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_pembayaran" value="<?= $DATA1['id_pembayaran'] ?>">
                        <input type="hidden" name="id_client" value="<?= $DATA1['id_client'] ?>">
                        <input type="hidden" name="id_pemesanan" value="<?= $DATA1['id_pemesanan'] ?>">
                        <input type="hidden" name="id_paket_layanan" value="<?= $DATA1['id_paket_layanan'] ?>">
                        <input type="hidden" name="total_pembayaran" value="<?= $TOTAL_PEMBAYARAN ?>">
                        <p>Bukti Transfer</p>
                        <label for="fileInput" class="label-upload">
                            Upload File
                            <input type="file" id="fileInput" name="foto">
                        </label>
                        <p class="file-name" id="fileName"></p>
                        <button type="submit" class="btn btn-primary" name="submit">Simpan Pembayaran</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        // Menambahkan event listener untuk menampilkan nama file terpilih
        const fileInput = document.getElementById('fileInput');
        const fileNameDisplay = document.getElementById('fileName');

        fileInput.addEventListener('change', function() {
            fileNameDisplay.textContent = this.files.length > 0 ? this.files[0].name : '';
        });
    </script>
</body>

</html>