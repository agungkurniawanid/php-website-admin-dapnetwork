<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/all.css" />
  <link rel="stylesheet" href="css/card-dashboard-utama.css" />
  <link rel="stylesheet" href="css/card-dashboard-client.css" />
</head>
<?php
require 'function/connection.php';

// todo generate hasil menjadi K, M 
function formatNominal($jumlah)
{
  $suffix = '';
  if ($jumlah >= 1000) {
    $suffix = 'K';
    $jumlah = $jumlah / 1000;
  }
  if ($jumlah >= 1000) {
    $suffix = 'M';
    $jumlah = $jumlah / 1000;
  }
  return number_format($jumlah, 2) . $suffix;
}

// todo menghitung pemasukan bulan ini 
$QUERY_TOTAL_PEMASUKAN  = mysqli_query($connection_database, "SELECT SUM(jumlah_nominal) AS total_pemasukan FROM tb_pemasukan WHERE MONTH(tanggal_pemasukan) = MONTH(NOW())");
$TOTAL_PEMASUKAN_BULAN_INI = mysqli_fetch_assoc($QUERY_TOTAL_PEMASUKAN);
$QUERY_TOTAL_PEMBAYARAN_BULAN_INI = mysqli_query($connection_database, "SELECT SUM(total_pembayaran) AS total_pembayaran FROM tb_catatan_pembayaran WHERE MONTH(tanggal_pembayaran) = MONTH(NOW())");
$TOTAL_PEMBAYARAN_BULAN_INI = mysqli_fetch_assoc($QUERY_TOTAL_PEMBAYARAN_BULAN_INI);

$RESULT_PEMASUKAN_BULAN_INI = $TOTAL_PEMASUKAN_BULAN_INI['total_pemasukan'] + $TOTAL_PEMBAYARAN_BULAN_INI['total_pembayaran'];

// todo menghitung pemasukan bulan lalu
$QUERY_TOTAL_PEMASUKAN_BULAN_LALU = mysqli_query($connection_database, "SELECT SUM(jumlah_nominal) AS total_pemasukan FROM tb_pemasukan WHERE MONTH(tanggal_pemasukan) = MONTH(NOW()) - 1 AND YEAR(tanggal_pemasukan) = YEAR(NOW())");
$TOTAL_PEMASUKAN_BULAN_LALU = mysqli_fetch_assoc($QUERY_TOTAL_PEMASUKAN_BULAN_LALU);
$QUERY_TOTAL_PEMBAYARAN_BULAN_LALU = mysqli_query($connection_database, "SELECT SUM(total_pembayaran) AS total_pembayaran FROM tb_catatan_pembayaran WHERE MONTH(tanggal_pembayaran) = MONTH(NOW()) - 1 AND YEAR(tanggal_pembayaran) = YEAR(NOW())");
$TOTAL_PEMBAYARAN_BULAN_LALU = mysqli_fetch_assoc($QUERY_TOTAL_PEMBAYARAN_BULAN_LALU);

$RESULT_PEMASUKAN_BULAN_LALU = $TOTAL_PEMASUKAN_BULAN_LALU['total_pemasukan'] + $TOTAL_PEMBAYARAN_BULAN_LALU['total_pembayaran'];

// todo menghitung pengeluaran bulan ini 
$QUERY_TOTAL_PENGELUARAN_BULAN_INI = mysqli_query($connection_database, "SELECT SUM(jumlah_nominal) AS total_pengeluaran FROM tb_pengeluaran WHERE MONTH(tanggal_pengeluaran) = MONTH(NOW())");
$TOTAL_PENGELUARAN_BULAN_INI = mysqli_fetch_assoc($QUERY_TOTAL_PENGELUARAN_BULAN_INI);
$QUERY_TOTAL_HARGA_PRODUCT = mysqli_query($connection_database,"SELECT SUM(harga_product * stok_product) AS total_harga_product FROM tb_product WHERE MONTH(tanggal_ditambahkan_product) = MONTH(NOW())");
$TOTAL_HARGA_PRODUCT = mysqli_fetch_assoc($QUERY_TOTAL_HARGA_PRODUCT);

$RESULT_PENGELUARAN_BULAN_INI = $TOTAL_PENGELUARAN_BULAN_INI['total_pengeluaran'] + $TOTAL_HARGA_PRODUCT['total_harga_product'];

// todo menghitung pengeluaran bulan lalu
$QUERY_TOTAL_PENGELUARAN_BULAN_LALU = mysqli_query($connection_database, "SELECT SUM(jumlah_nominal) AS total_pengeluaran FROM tb_pengeluaran WHERE MONTH(tanggal_pengeluaran) = MONTH(NOW()) - 1");
$TOTAL_PENGELUARAN_BULAN_LALU = mysqli_fetch_assoc($QUERY_TOTAL_PENGELUARAN_BULAN_LALU);
$QUERY_TOTAL_HARGA_PRODUCT_BULAN_LALU = mysqli_query($connection_database,"SELECT SUM(harga_product) AS total_harga_product FROM tb_product WHERE MONTH(tanggal_ditambahkan_product) = MONTH(NOW()) - 1");
$TOTAL_HARGA_PRODUCT_BULAN_LALU = mysqli_fetch_assoc($QUERY_TOTAL_HARGA_PRODUCT_BULAN_LALU);

$RESULT_PENGELUARAN_BULAN_LALU = $TOTAL_PENGELUARAN_BULAN_LALU['total_pengeluaran'] + $TOTAL_HARGA_PRODUCT_BULAN_LALU['total_harga_product'];

// todo menghitung untung bulan ini
$UNTUNG = $TOTAL_PEMASUKAN_BULAN_INI['total_pemasukan'] - $RESULT_PENGELUARAN_BULAN_INI;

// todo menghitung untung bulan lalu 
$UNTUNG_BULAN_LALU = $TOTAL_PEMASUKAN_BULAN_LALU['total_pemasukan'] - $TOTAL_PENGELUARAN_BULAN_LALU['total_pengeluaran'];

// todo menghitung kerugian bulan ini
$KERUGIAN_BULAN_INI = max(0, $TOTAL_PENGELUARAN_BULAN_INI['total_pengeluaran'] - $TOTAL_PEMASUKAN_BULAN_INI['total_pemasukan']);

// todo menghitung kerugian bulan lalu
$KERUGIAN_BULAN_LALU = max(0, $TOTAL_PENGELUARAN_BULAN_LALU['total_pengeluaran'] - $TOTAL_PEMASUKAN_BULAN_LALU['total_pemasukan']);

// todo menampilkan total product 
$SQL_SELECT_PRODUCT = mysqli_query($connection_database, "SELECT COUNT(*) AS total_product FROM tb_product");
$TOTAL_PRODUCT = mysqli_fetch_assoc($SQL_SELECT_PRODUCT);

// todo menampilkan total client bulan ini
$SQL_SELECT_CLIENT_BULAN_INI = mysqli_query($connection_database, "SELECT * FROM tb_client JOIN tb_pemesanan ON tb_client.id_client = tb_pemesanan.id_client JOIN tb_paket_layanan ON tb_pemesanan.id_paket_layanan = tb_paket_layanan.id_paket_layanan WHERE MONTH(tanggal_masuk) = MONTH(NOW())");

// todo menampilkan total client 
$SQL_SELECT_CLIENT = mysqli_query($connection_database, "SELECT COUNT(*) AS total_client FROM tb_client WHERE MONTH(tanggal_masuk) = MONTH(NOW())");
$TOTAL_CLIENT = mysqli_fetch_assoc($SQL_SELECT_CLIENT);

// todo menampilkan total client sudah bayar bulan ini 
$QUERY_SELECT_CLIENT_BAYAR_BULAN_INI = mysqli_query($connection_database, "SELECT COUNT(*) AS total_client_bayar FROM tb_client JOIN tb_catatan_pembayaran ON tb_client.id_client = tb_catatan_pembayaran.id_client WHERE MONTH(tanggal_pembayaran) = MONTH(NOW()) AND status_pembayaran = 'Lunas'");
$TOTAL_CLIENT_BAYAR_BULAN_INI = mysqli_fetch_assoc($QUERY_SELECT_CLIENT_BAYAR_BULAN_INI);

// todo menampilkan total client belum bayar bulan ini 
$QUERY_SELECT_CLIENT_BELUM_BAYAR_BULAN_INI = mysqli_query($connection_database, "SELECT COUNT(*) AS total_client_belum_bayar FROM tb_client JOIN tb_catatan_pembayaran ON tb_client.id_client = tb_catatan_pembayaran.id_client WHERE MONTH(tanggal_pembayaran) = MONTH(NOW()) AND status_pembayaran = 'Belum Lunas'");
$TOTAL_CLIENT_BELUM_BAYAR_BULAN_INI = mysqli_fetch_assoc($QUERY_SELECT_CLIENT_BELUM_BAYAR_BULAN_INI);
?>

<body>
  <div class="wrapper-konten-dashboard">
    <div class="wrapper-card-informasi-card-cek-product">
      <!-- ? card 1  -->
      <div class="card-informasi card-content1">
        <div class="header">
          <div class="title">
            <p>informasi Bulan ini - <?= date('F') ?></p>
            <p>rangkuman informasi</p>
          </div>
          <div class="cetak">
          </div>
        </div>
        <div class="body">
          <div class="card-body" id="pemasukan">
            <div class="icon">
              <img src="svg/pemasukan.svg" alt="icon pemasukan" />
            </div>
            <div class="nominal">Rp. <?= formatNominal($RESULT_PEMASUKAN_BULAN_INI) ?></div>
            <div class="title-nominal">Total Pemasukan</div>
            <div class="deskripsi">+Rp. <?= formatNominal($RESULT_PEMASUKAN_BULAN_LALU) ?> dari bulan lalu</div>
          </div>
          <div class="card-body" id="pengeluaran">
            <div class="icon">
              <img src="svg/pengeluaran.svg" alt="icon pengeluaran" />
            </div>
            <div class="nominal">Rp. <?= formatNominal($RESULT_PENGELUARAN_BULAN_INI) ?></div>
            <div class="title-nominal">Total Pengeluaran</div>
            <div class="deskripsi">+Rp. <?= formatNominal($RESULT_PENGELUARAN_BULAN_LALU) ?> dari bulan lalu</div>
          </div>
          <div class="card-body" id="keuntungan">
            <div class="icon">
              <img src="svg/keuntungan.svg" alt="icon keuntungan" />
            </div>
            <div class="nominal">Rp. <?= formatNominal($UNTUNG) ?></div>
            <div class="title-nominal">Total Keuntungan</div>
            <div class="deskripsi">+Rp. <?= formatNominal($UNTUNG_BULAN_LALU) ?> untung bulan lalu</div>
          </div>
          <div class="card-body" id="kerugian">
            <div class="icon">
              <img src="svg/kerugian.svg" alt="icon kerugian" />
            </div>
            <div class="nominal">Rp. <?= formatNominal($KERUGIAN_BULAN_INI) ?></div>
            <div class="title-nominal">Total Kerugian</div>
            <div class="deskripsi">+Rp. <?= formatNominal($KERUGIAN_BULAN_LALU) ?> rugi bulan lalu</div>
          </div>
        </div>
      </div>
      <!-- ? card 2 -->
      <div class="card-cek-product card-content1">
        <div class="title-subtitle">
          <div class="title">Alat Tersedia Digunakan</div>
          <div class="subtitle">
            Siap digunakan untuk instalasi pelanggan baru
          </div>
        </div>
        <div class="daftar-product">
          <a href="#">router</a>
          <a href="#">patch core</a>
          <a href="#">LAN Kabel</a>
          <a href="#">Splitter</a>
          <a href="#">Connector</a>
          <a href="#">Lainnya</a>
        </div>
        <div class="button">
          <div class="total-product">
            <p>Total Product</p>
            <p><?= $TOTAL_PRODUCT['total_product'] ?> product</p>
          </div>
          <div class="btn"><button onclick="window.location.href='dsb-halaman-product.php'">Lihat Product</button></div>
        </div>
      </div>
    </div>
    <!-- ? card 3  -->
    <div class="wrapper-card-info-client">
      <div class="card-client-baru animation-card-union-dua">
        <div class="header">
          <div class="title-card">Client Baru</div>
          <div class="subtitle-card">Bulan <?= date('F') ?> <?= date('Y') ?></div>
        </div>
        <div class="container-body">
          <div class="body">
            <?php foreach ($SQL_SELECT_CLIENT_BULAN_INI as $value) : ?>
              <a href="page/page-detail-client.php?id_client=<?= $value['id_client'] ?>">
                <div class="image-name-paketdipesan">
                  <div class="image">
                    <img src="images/<?= $value['foto_client'] ?>" alt="profile user"/>
                  </div>
                  <div class="name-paketdipesan">
                    <div class="name"><?= $value['nama_client'] ?></div>
                    <div class="paketdipesan">
                      <?= $value['jenis_paket_layanan'] ?>
                    </div>
                  </div>
                </div>
                <div class="button">
                  <img src="svg/arrow-small-right.svg" alt="arro icon" />
                </div>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="footer">
          <div class="total-client"><?= $TOTAL_CLIENT['total_client'] ?> Client</div>
          <div class="tombol-lihat-semua">
            <a href="page/page-cardinformasi-client-barudaftar.php">
              <div>lihat semua</div>
              <div>
                <img src="svg/arrow-small-right-blue.svg" alt="arrow icon" />
              </div>
            </a>
          </div>
        </div>
      </div>
      <div class="card-client-metode-pembayaran animation-card-union-dua">
        <div class="header">
          <div class="title-card">Metode Pembayaran</div>
        </div>
        <div class="wrapper-body-footer">
          <div class="body">
            <?php require 'data/metode-bayar.php' ?>
            <?php foreach ($METODE_BAYAR as $metodeBayar) : ?>
              <div class="image-name-deskripsi">
                <div class="image">
                  <img src="<?= $metodeBayar['foto method'] ?>" alt="image"/>
                </div>
                <div class="name-deskripsi">
                  <div class="name"><?= $metodeBayar['judul'] ?></div>
                  <div class="deskripsi"><?= $metodeBayar['deskripsi'] ?></div>
                </div>
              </div>
            <?php endforeach ?>
          </div>
          <div class="footer">
            <a href="dsb-halaman-transaksi.php" class="button-client-metode">lihat detail</a>
          </div>
        </div>
      </div>
      <div class="card-client-sudah-dan-belum-bayar animation-card-union-dua">
        <div class="card-client-sudah-bayar">
          <p>Sudah Bayar Bulan <?= date('F') ?></p>
          <p>Daftar client sudah bayar bulan <?= date('F') ?></p>
          <div class="container-wrapper-icon-title-pay">
            <div class="wrapper-icon-title-client-pay">
              <div class="icon">
                <img src="svg/pengguna.svg" alt="icon" />
              </div>
              <div class="title">
                <div>Client Sudah Bayar</div>
                <div><?= $TOTAL_CLIENT_BAYAR_BULAN_INI['total_client_bayar'] ?> Client</div>
              </div>
            </div>
            <div class="button">
              <a href="page/page-cardinformasi-client-sudahbayar.php"><img src="svg/arrow-small-right.svg" alt="arrow icon" id="icon-detail" /></a>
            </div>
          </div>
        </div>
        <div class="card-client-belum-bayar">
          <p>Belum Bayar Bulan <?= date('F')?></p>
          <p>Daftar client belum bayar bulan <?= date('F')?></p>
          <div class="container-wrapper-icon-title-pay">
            <div class="wrapper-icon-title-client-pay">
              <div class="icon">
                <img src="svg/pengguna.svg" alt="icon" />
              </div>
              <div class="title">
                <div>Client Sudah Bayar</div>
                <div><?= $TOTAL_CLIENT_BELUM_BAYAR_BULAN_INI['total_client_belum_bayar'] ?> Client</div>
              </div>
            </div>
            <div class="button">
              <a href="page/page-cardinformasi-client-belumbayar.php"><img src="svg/arrow-small-right.svg" alt="arrow icon" id="icon-detail" /></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="js/page-halaman-utama.js"></script>
</body>

</html>