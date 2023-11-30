<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <title>Pengeluaran - Dapnetwork</title>
</head>
<?php
require 'function/connection.php';
require 'function/tambah-pengeluaran.php';
require 'function/hapus-pengeluaran.php';

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

// todo untuk fungsi insert pengeluaran 
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
        if (Insertpengeluaran($_POST) > 0) {
            echo "
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        Swal.fire({
                            icon: 'success',
                            title: 'Selamat...',
                            text: 'Pengeluaran berhasil ditambahkan',
                            timer: 1000,
                            showConfirmButton: false,
                        }).then(function () {
                            window.location.href = 'dsb-halaman-pengeluaran.php';
                        })
                    });
                </script>
            ";
        }
    }
}

// todo menampilkan data tb pengeluaran 
$query_tb_pengeluaran = mysqli_query($connection_database, "SELECT * FROM tb_pengeluaran");

// todo fungsi hapus 
if(isset($_GET['pengeluaran'])) {
    $id = $_GET['pengeluaran'];
    $affected_rows = hapusPengeluaran($id);
    if ($affected_rows > 0) {
        echo "
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'success',
                        title: 'Selamat...',
                        text: 'Pengeluaran berhasil di hapus',
                        timer: 1000,
                        showConfirmButton: false,
                    }).then(function () {
                        window.location.href = 'dsb-halaman-pengeluaran.php';
                    })
                });
            </script>
        ";
    }
}

// ? total pendapatan usaha hari ini 
// dari tb pengeluaran 
$SQL_TOTAL_PENDAPATAN_USAHA_HARI_INI = "SELECT SUM(jumlah_nominal) AS total_jumlah_nominal_hari_ini FROM tb_pengeluaran WHERE tanggal_pengeluaran = CURDATE()";
// proses query 
$QUERY_TPU_HARI_INI = mysqli_query($connection_database, $SQL_TOTAL_PENDAPATAN_USAHA_HARI_INI);
// ambil data
$TOTAL_PENDAPATAN_USAHA_HARI_INI = mysqli_fetch_assoc($QUERY_TPU_HARI_INI);
// pastikan variabel yang diambil tidak null
$total_jumlah_nominal_hari_ini = isset($TOTAL_PENDAPATAN_USAHA_HARI_INI['total_jumlah_nominal_hari_ini']) ? $TOTAL_PENDAPATAN_USAHA_HARI_INI['total_jumlah_nominal_hari_ini'] : 0;

// ? total pendapatan usaha minggu ini 
// dari tb pengeluaran
$SQL_TOTAL_PENDAPATAN_USAHA_MINGGU_INI = "SELECT SUM(jumlah_nominal) AS total_jumlah_nominal_minggu_ini FROM tb_pengeluaran WHERE WEEK(tanggal_pengeluaran) = WEEK(CURDATE())";
// proses query
$QUERY_TPU_MINGGU_INI = mysqli_query($connection_database, $SQL_TOTAL_PENDAPATAN_USAHA_MINGGU_INI);
// ambil data
$TOTAL_PENDAPATAN_USAHA_MINGGU_INI = mysqli_fetch_assoc($QUERY_TPU_MINGGU_INI);
// pastikan variabel yang diambil tidak null
$total_jumlah_nominal_minggu_ini = isset($TOTAL_PENDAPATAN_USAHA_MINGGU_INI['total_jumlah_nominal_minggu_ini']) ? $TOTAL_PENDAPATAN_USAHA_MINGGU_INI['total_jumlah_nominal_minggu_ini'] : 0;

// ? total pendapatan usaha bulan ini 
// dari tb pengeluaran
$SQL_TOTAL_PENDAPATAN_USAHA_BULAN_INI = "SELECT SUM(jumlah_nominal) AS total_jumlah_nominal_bulan_ini FROM tb_pengeluaran WHERE MONTH(tanggal_pengeluaran) = MONTH(CURDATE())";
// proses query
$QUERY_TPU_BULAN_INI = mysqli_query($connection_database, $SQL_TOTAL_PENDAPATAN_USAHA_BULAN_INI);
// ambil data
$TOTAL_PENDAPATAN_USAHA_BULAN_INI = mysqli_fetch_assoc($QUERY_TPU_BULAN_INI);
// pastikan variabel yang diambil tidak null
$total_jumlah_nominal_bulan_ini = isset($TOTAL_PENDAPATAN_USAHA_BULAN_INI['total_jumlah_nominal_bulan_ini']) ? $TOTAL_PENDAPATAN_USAHA_BULAN_INI['total_jumlah_nominal_bulan_ini'] : 0;

// ? total pendapatan usaha tahun ini 
// dari tb pengeluaran
$SQL_TOTAL_PENDAPATAN_USAHA_TAHUN_INI = "SELECT SUM(jumlah_nominal) AS total_jumlah_nominal_tahun_ini FROM tb_pengeluaran WHERE YEAR(tanggal_pengeluaran) = YEAR(CURDATE())";
// proses query
$QUERY_TPU_TAHUN_INI = mysqli_query($connection_database, $SQL_TOTAL_PENDAPATAN_USAHA_TAHUN_INI);
// ambil data
$TOTAL_PENDAPATAN_USAHA_TAHUN_INI = mysqli_fetch_assoc($QUERY_TPU_TAHUN_INI);
// pastikan variabel yang diambil tidak null
$total_jumlah_nominal_tahun_ini = isset($TOTAL_PENDAPATAN_USAHA_TAHUN_INI['total_jumlah_nominal_tahun_ini']) ? $TOTAL_PENDAPATAN_USAHA_TAHUN_INI['total_jumlah_nominal_tahun_ini'] : 0;


?>

<body>
    <div class="container-page-pengeluaran">
        <div class="subcontainer">
            <div class="wrapper-info-card">
                <div class="card">
                    <div>
                        <p>Hari ini - <?= $hariIndonesia ?></p>
                        <p>Total Pengeluaran Usaha hari ini</p>
                    </div>
                    <div>
                        <h1>Rp. <?= number_format($total_jumlah_nominal_hari_ini, 0, ',', '.')?></h1>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <p>Minggu ini</p>
                        <p>Total Pengeluaran minggu ini</p>
                    </div>
                    <div>
                        <h1>Rp. <?= number_format($total_jumlah_nominal_minggu_ini, 0, ',', '.')?></h1>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <p>Bulan ini - <?= date('F') ?></p>
                        <p>Total Pengeluaran bulan ini</p>
                    </div>
                    <div>
                        <h1>Rp. <?= number_format($total_jumlah_nominal_bulan_ini, 0, ',', '.') ?></h1>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <p>Tahun ini - <?= date('Y') ?></p>
                        <p>Total Pengeluaran tahun ini</p>
                    </div>
                    <div>
                        <h1>Rp. <?= number_format($total_jumlah_nominal_tahun_ini, 0, ',', '.')?></h1>
                    </div>
                </div>
            </div>
            <div class="komponent-3">
                <div class="wrapper-table">
                    <div class="wrapper-heading-btntambah-cari">
                        <div class="heading">
                            <p>Table pengeluaran</p>
                        </div>
                        <div class="search">
                            <label for="search"><img src="svg/search.svg" alt="icon search" /></label>
                            <input type="text" name="search" id="search" placeholder="Cari client" oninput="cariPengeluaran(this.value)" />
                        </div>
                        <div class="btntambah">
                            <button type="button" id="btn-tambah-pengeluaran">Tambah</button>
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
                                <?php $No = 1; ?>
                                <?php foreach ($query_tb_pengeluaran as $data) : ?>
                                    <tr>
                                        <td><?= $No;
                                            $No++ ?></td>
                                        <td><?= $data['id_pengeluaran'] ?></td>
                                        <td><?= date('d F Y', strtotime($data['tanggal_pengeluaran'])) ?></td>
                                        <td><?= $data['kategori_pengeluaran'] ?></td>
                                        <td><?= $data['deskripsi_pengeluaran'] ?></td>
                                        <td>Rp. <?= number_format($data['jumlah_nominal'], 0, ',', '.') ?></td>
                                        <td><a href="page/page-update-pengeluaran.php?update-pengeluaran=<?= $data['id_pengeluaran'] ?>"><img src="svg/edit.svg" alt=""></a></td>
                                        <td><a href="#" onclick="hapusPengeluaran('<?= $data['id_pengeluaran'] ?>')"><img src="svg/trash.svg" alt=""></a></td>
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
    <div class="overlay-page-pengeluaran"></div>
    <div class="modal-page-pengeluaran">
        <img id="closeInsertPengeluaran" src="svg/cross-small.svg" alt="okok">
        <form class="form" action="" method="post">
            <div class="separator">
                <hr class="line">
                <p>Tambah Pengeluaran</p>
                <hr class="line">
            </div>
            <div class="credit-card-info--form">
                <div class="input_container">
                    <label for="password_field" class="input_label">Kategori Pengeluaran</label>
                    <input id="password_field" class="input_field" type="text" name="kategoripengeluaran" title="Inpit title" placeholder="Contoh : Listrik">
                </div>
                <div class="input_container">
                    <label for="password_field" class="input_label">Deskripsi pengeluaran</label>
                    <input id="password_field" class="input_field" type="text" name="deskripsipengeluaran" title="Inpit title" placeholder="Deskripsikan pengeluaran tersebut">
                </div>
                <div class="input_container">
                    <label for="password_field" class="input_label">Jumlah Nominal</label>
                    <input id="password_field" class="input_field" type="number" name="jumlahnominal" title="Inpit title" placeholder="Masukkan nominal">
                </div>
            </div>
            <button type="submit" name="submit" class="purchase--btn">Simpan</button>
        </form>
    </div>
    <script>
        function cariPengeluaran(keyword) {
            $.ajax({
                type: 'POST',
                url: 'function/cari-pengeluaran.php', // Sesuaikan dengan nama file yang tepat
                data: {
                    keyword: keyword
                },
                success: function(data) {
                    $('.table tbody').html(data);
                }
            });
        }

        const hapusPengeluaran = (id) => {
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
                    window.location.href = '?pengeluaran=' + id;
                }
            });
        }
    </script>
</body>

</html>