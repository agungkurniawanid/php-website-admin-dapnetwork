<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/page-pemesanan.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Pemesanan - Dapnetwork</title>
</head>

<?php
require 'function/tambah-pemasukan.php';
require 'function/hapus-pemasukan.php';

// todo fungsi untuk menampilkan hari bahasa indonesia 
function konversiHari($hari)
{
    $namaHari = [
        'Sun' => 'Minggu',
        'Mon' => 'Senin',
        'Tue' => 'Selasa',
        'Wed' => 'Rabu',
        'Thu' => 'Kamis',
        'Fri' => 'Jumat',
        'Sat' => 'Sabtu'
    ];
    return $namaHari[$hari];
}
$hariInggris = date('D');
$hariIndonesia = konversiHari($hariInggris);

// todo fungsi insert 
if (isset($_POST['submit'])) {
    if (empty($_POST['jumlahnominal'])) {
        echo "
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Maaf....',
                        text: 'Jumlah nominal tidak boleh kosong',
                        timer: 1000,
                        showConfirmButton: false,
                    });
                });
            </script>
        ";
    } else {
        if (InsertPemasukan($_POST) > 0) {
            echo "
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        Swal.fire({
                            icon: 'success',
                            title: 'Selamat...',
                            text: 'Pemasukan berhasil ditambahkan',
                            timer: 1000,
                            showConfirmButton: false,
                        });
                    });
                </script>
            ";
        }
    }
}

// todo fungsi menampilkan data tb pemasukan 
$SQL_TBPEMASUKAN = "SELECT * FROM tb_pemasukan ORDER BY jumlah_nominal DESC";
$PROSES_TBPEMASUKAN = mysqli_query($connection_database, $SQL_TBPEMASUKAN);

// todo fungsi hapus 
if (isset($_GET["id_pemasukan"])) {
    $id = $_GET["id_pemasukan"];
    $affected_rows = hapusPemasukan($id);
    if ($affected_rows > 0) {
        echo "
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'success',
                        title: 'Selamat...',
                        text: 'Pemasukan berhasil dihapus',
                        timer: 1000,
                        showConfirmButton: false,
                    }).then(function (result) {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            window.location.href='dsb-halaman-pemasukan.php';
                        }
                    });
                });
            </script>
        ";
    }
}

// ? total pendapatan dari usaha 
// dari tb pemasukan 
$SQL_TOTAL_PENDAPATAN_USAHA = "SELECT SUM(jumlah_nominal) AS jumlah_nominal FROM tb_pemasukan WHERE sumber_pemasukan = 'Pendapatan Usaha' AND YEAR(tanggal_pemasukan) = YEAR(CURDATE())";
// dari tb catatan pembayaran 
$SQL_TOTAL_PEMBAYARAN = "SELECT SUM(total_pembayaran) AS total_pembayaran FROM tb_catatan_pembayaran WHERE YEAR(tanggal_pembayaran) = YEAR(CURDATE())";
// proses query 
$QUERY_TPU = mysqli_query($connection_database, $SQL_TOTAL_PENDAPATAN_USAHA);
$QUERY_TP = mysqli_query($connection_database, $SQL_TOTAL_PEMBAYARAN);
// ambil data 
$TOTAL_PENDAPATAN_USAHA = mysqli_fetch_assoc($QUERY_TPU);
$TOTAL_PEMBAYARAN = mysqli_fetch_assoc($QUERY_TP);
// pastikan variabel yang diambil tidak null
$jumlah_nominal = isset($TOTAL_PENDAPATAN_USAHA['jumlah_nominal']) ? $TOTAL_PENDAPATAN_USAHA['jumlah_nominal'] : 0;
$total_pembayaran = isset($TOTAL_PEMBAYARAN['total_pembayaran']) ? $TOTAL_PEMBAYARAN['total_pembayaran'] : 0;
// tambahkan keduanya 
$TOTAL_PENDAPATAN_USAHA_TAHUN_INI = $jumlah_nominal + $total_pembayaran;

// ? total untuk pendapatan modal usaha 
// dari tb pemasukan 
$SQL_TOTAL_PENDAPATAN_MODAL = "SELECT SUM(jumlah_nominal) AS total_modal FROM tb_pemasukan WHERE sumber_pemasukan = 'Modal Usaha' AND YEAR(tanggal_pemasukan) = YEAR(CURDATE())";
// proses query 
$QUERY_TPM = mysqli_query($connection_database, $SQL_TOTAL_PENDAPATAN_MODAL);
// ambil data 
$TOTAL_PENDAPATAN_MODAL = mysqli_fetch_assoc($QUERY_TPM);

// ? total pendapatan usaha hari ini 
// dari tb pemasukan 
$SQL_TOTAL_PENDAPATAN_USAHA_HARI_INI = "SELECT SUM(jumlah_nominal) AS jumlah_nominal_hari_ini FROM tb_pemasukan WHERE sumber_pemasukan = 'Pendapatan Usaha' AND tanggal_pemasukan = CURDATE()";
// dari tb catatan pembayaran 
$SQL_TOTAL_PEMBAYARAN_HARI_INI = "SELECT SUM(total_pembayaran) AS total_pembayaran_hari_ini FROM tb_catatan_pembayaran WHERE tanggal_pembayaran = CURDATE()";
// proses query 
$QUERY_TPU_HARI_INI = mysqli_query($connection_database, $SQL_TOTAL_PENDAPATAN_USAHA_HARI_INI);
$QUERY_TP_HARI_INI = mysqli_query($connection_database, $SQL_TOTAL_PEMBAYARAN_HARI_INI);
// ambil data 
$TOTAL_PENDAPATAN_USAHA_HARI_INI = mysqli_fetch_assoc($QUERY_TPU_HARI_INI);
$TOTAL_PEMBAYARAN_HARI_INI = mysqli_fetch_assoc($QUERY_TP_HARI_INI);
// pastikan variabel yang diambil tidak null
$jumlah_nominal_hari_ini = isset($TOTAL_PENDAPATAN_USAHA_HARI_INI['jumlah_nominal_hari_ini']) ? $TOTAL_PENDAPATAN_USAHA_HARI_INI['jumlah_nominal_hari_ini'] : 0;
$total_pembayaran_hari_ini = isset($TOTAL_PEMBAYARAN_HARI_INI['total_pembayaran_hari_ini']) ? $TOTAL_PEMBAYARAN_HARI_INI['total_pembayaran_hari_ini'] : 0;
// tambahkan keduanya 
$TAMBAH_TOTAL_PENDAPATAN_USAHA_HARI_INI = $jumlah_nominal_hari_ini + $total_pembayaran_hari_ini;

// ? total pendapatan usaha minggu ini 
// dari tb pemasukan
$SQL_TOTAL_PENDAPATAN_USAHA_MINGGU_INI = "SELECT SUM(jumlah_nominal) AS minggu_nominal FROM tb_pemasukan WHERE sumber_pemasukan = 'Pendapatan Usaha' AND WEEK(tanggal_pemasukan) = WEEK(CURDATE())";
// dari tb catatan pembayaran
$SQL_TOTAL_PEMBAYARAN_MINGGU_INI = "SELECT SUM(total_pembayaran) AS minggu_pembayaran FROM tb_catatan_pembayaran WHERE WEEK(tanggal_pembayaran) = WEEK(CURDATE())";
// proses query
$QUERY_TPU_MINGGU_INI = mysqli_query($connection_database, $SQL_TOTAL_PENDAPATAN_USAHA_MINGGU_INI);
$QUERY_TP_MINGGU_INI = mysqli_query($connection_database, $SQL_TOTAL_PEMBAYARAN_MINGGU_INI);
// ambil data
$TOTAL_PENDAPATAN_USAHA_MINGGU_INI = mysqli_fetch_assoc($QUERY_TPU_MINGGU_INI);
$TOTAL_PEMBAYARAN_MINGGU_INI = mysqli_fetch_assoc($QUERY_TP_MINGGU_INI);
// pastikan variabel yang diambil tidak null
$jumlah_nominal_minggu_ini = isset($TOTAL_PENDAPATAN_USAHA_MINGGU_INI['minggu_nominal']) ? $TOTAL_PENDAPATAN_USAHA_MINGGU_INI['minggu_nominal'] : 0;
$total_pembayaran_minggu_ini = isset($TOTAL_PEMBAYARAN_MINGGU_INI['minggu_pembayaran']) ? $TOTAL_PEMBAYARAN_MINGGU_INI['minggu_pembayaran'] : 0;
// tambahkan keduanya
$TAMBAH_TOTAL_PENDAPATAN_USAHA_MINGGU_INI = $jumlah_nominal_minggu_ini + $total_pembayaran_minggu_ini;

// ? total pendapatan usaha bulan ini 
// dari tb pemasukan
$SQL_TOTAL_PENDAPATAN_USAHA_BULAN_INI = "SELECT SUM(jumlah_nominal) AS bulan_nominal FROM tb_pemasukan WHERE sumber_pemasukan = 'Pendapatan Usaha' AND MONTH(tanggal_pemasukan) = MONTH(CURDATE())";
// dari tb catatan pembayaran
$SQL_TOTAL_PEMBAYARAN_BULAN_INI = "SELECT SUM(total_pembayaran) AS bulan_pembayaran FROM tb_catatan_pembayaran WHERE MONTH(tanggal_pembayaran) = MONTH(CURDATE())";
// proses query
$QUERY_TPU_BULAN_INI = mysqli_query($connection_database, $SQL_TOTAL_PENDAPATAN_USAHA_BULAN_INI);
$QUERY_TP_BULAN_INI = mysqli_query($connection_database, $SQL_TOTAL_PEMBAYARAN_BULAN_INI);
// ambil data
$TOTAL_PENDAPATAN_USAHA_BULAN_INI = mysqli_fetch_assoc($QUERY_TPU_BULAN_INI);
$TOTAL_PEMBAYARAN_BULAN_INI = mysqli_fetch_assoc($QUERY_TP_BULAN_INI);
// pastikan variabel yang diambil tidak null
$jumlah_nominal_bulan_ini = isset($TOTAL_PENDAPATAN_USAHA_BULAN_INI['bulan_nominal']) ? $TOTAL_PENDAPATAN_USAHA_BULAN_INI['bulan_nominal'] : 0;
$total_pembayaran_bulan_ini = isset($TOTAL_PEMBAYARAN_BULAN_INI['bulan_pembayaran']) ? $TOTAL_PEMBAYARAN_BULAN_INI['bulan_pembayaran'] : 0;
// tambahkan keduanya
$TAMBAH_TOTAL_PENDAPATAN_USAHA_BULAN_INI = $jumlah_nominal_bulan_ini + $total_pembayaran_bulan_ini;

?>

<body>
    <div class="container-page-pemesanan">
        <div class="subcontainer">
            <div class="komponent-1">
                <div class="card-pendapatanusaha">
                    <div class="bagian-1">
                        <p>Pendapatan Usaha</p>
                        <h1>Total pendapatan dari usaha</h1>
                        <p>Pendapatan usaha didapatkan dari semua total pembayaran client.</p>
                    </div>
                    <div class="bagian-2">
                        <p>Jumlah Total Nominal</p>
                        <h1>Rp. <?= number_format($TOTAL_PENDAPATAN_USAHA_TAHUN_INI, 0, ',', '.') ?></h1>
                    </div>
                </div>
                <div class="card-pemasukanmodal">
                    <div class="bagian-1">
                        <p>Pendapatan Usaha</p>
                        <h1>Total pendapatan Modal</h1>
                        <p>Pendapatan usaha didapatkan dari Modal Usaha.</p>
                    </div>
                    <div class="bagian-2">
                        <p>Jumlah Total Nominal</p>
                        <h1>Rp. <?= number_format($TOTAL_PENDAPATAN_MODAL['total_modal'], 0, ',', '.') ?></h1>
                    </div>
                </div>
            </div>
            <div class="komponent-2">
                <div class="card">
                    <div>
                        <p>Hari ini - <?= $hariIndonesia ?></p>
                        <p>Total Pendapatan Usaha hari ini</p>
                    </div>
                    <div>
                        <h1>Rp. <?= number_format($TAMBAH_TOTAL_PENDAPATAN_USAHA_HARI_INI, 0, ',', '.') ?></h1>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <p>Minggu ini</p>
                        <p>Total Pendapatan Usaha hari ini</p>
                    </div>
                    <div>
                        <h1>Rp. <?= number_format($TAMBAH_TOTAL_PENDAPATAN_USAHA_MINGGU_INI, 0, ',', '.') ?></h1>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <p>Bulan ini - <?= date('F') ?></p>
                        <p>Total Pendapatan Usaha Minggu ini</p>
                    </div>
                    <div>
                        <h1>Rp. <?= number_format($TAMBAH_TOTAL_PENDAPATAN_USAHA_BULAN_INI, 0, ',', '.') ?></h1>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <p>Tahun ini - <?= date('Y') ?></p>
                        <p>Total Pendapatan Usaha hari ini</p>
                    </div>
                    <div>
                        <h1>Rp. <?= number_format($TOTAL_PENDAPATAN_USAHA_TAHUN_INI, 0, ',', '.') ?></h1>
                    </div>
                </div>
            </div>
            <div class="komponent-3">
                <div class="wrapper-table">
                    <div class="wrapper-heading-btntambah-cari">
                        <div class="heading">
                            <p>Table Pemasukan</p>
                        </div>
                        <div class="search">
                            <label for="search"><img src="svg/search.svg" alt="icon search" /></label>
                            <input type="text" name="search" id="search" placeholder="Cari client" oninput="cariPemasukan(this.value)" />
                        </div>
                        <div class="btntambah">
                            <button type="button" id="btn-tambah-pemasukan">Tambah</button>
                        </div>
                    </div>
                    <div class="table">
                        <table>
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>ID</th>
                                    <th>Tanggal</th>
                                    <th>Sumber</th>
                                    <th>Deskripsi</th>
                                    <th>Nominal</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $No = 0;
                                $No++ ?>
                                <?php foreach ($PROSES_TBPEMASUKAN as $pemasukan) : ?>
                                    <tr>
                                        <td><?= $No ?></td>
                                        <td><?= $pemasukan['id_pemasukan'] ?></td>
                                        <td><?= date('d F Y', strtotime($pemasukan['tanggal_pemasukan'])) ?></td>
                                        <td><?= $pemasukan['sumber_pemasukan'] ?></td>
                                        <td><?= $pemasukan['deskripsi_pemasukan'] ?></td>
                                        <td>Rp. <?= number_format($pemasukan['jumlah_nominal'], 0, ',', '.') ?></td>
                                        <td><a href="page/page-update-pemasukan.php?update-pemasukan=<?= $pemasukan['id_pemasukan'] ?>"><img src="svg/edit.svg" alt=""></a></td>
                                        <td><a href="#" onclick="hapusPemasukan('<?= $pemasukan['id_pemasukan'] ?>')"><img src="svg/trash.svg" alt=""></a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- untuk modals insert  -->
    <div class="overlay-page-pemasukan"></div>
    <div class="modal-page-pemasukan">
        <img id="closeInsertPemasukan" src="svg/cross-small.svg" alt="okok">
        <form class="form" action="" method="post">
            <div class="separator">
                <hr class="line">
                <p>Tambah Pemasukan</p>
                <hr class="line">
            </div>
            <div class="credit-card-info--form">
                <div class="input_container">
                    <label for="password_field" class="input_label">Sumber Pemasukan</label>
                    <select class="input_field" name="sumberpemasukan" id="sumberpemasukan">
                        <option value="Pendapatan Usaha">Pendapatan Usaha</option>
                        <option value="Modal Usaha">Modal Usaha</option>
                    </select>
                </div>
                <div class="input_container">
                    <label for="password_field" class="input_label">Deskripsi pemasukan</label>
                    <input id="password_field" class="input_field" type="text" name="deskripsipemasukan" title="Inpit title" placeholder="Deskripsikan pemasukan tersebut">
                </div>
                <div class="input_container">
                    <label for="password_field" class="input_label">Deskripsi pemasukan</label>
                    <input id="password_field" class="input_field" type="number" name="jumlahnominal" title="Inpit title" placeholder="Masukkan nominal">
                </div>
            </div>
            <button type="submit" name="submit" class="purchase--btn">Simpan</button>
        </form>
    </div>
    <script>
        function cariPemasukan(keyword) {
            $.ajax({
                type: 'POST',
                url: 'function/cari-pemasukan.php', // Sesuaikan dengan nama file yang tepat
                data: {
                    keyword: keyword
                },
                success: function(data) {
                    $('.table tbody').html(data);
                }
            });
        }

        const hapusPemasukan = (id) => {
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '?id_pemasukan=' + id;
                }
            });
        }
    </script>
</body>

</html>