<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/all.css" />
    <link rel="stylesheet" href="../dist/output.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Product Keluar</title>
</head>

<?php
require '../function/connection.php';
require '../function/tambahkeluar.php';
require '../function/hapus-product-keluar.php';

// todo fungsi insert produdct 
if (isset($_POST['submit'])) {
    if (empty($_POST['jumlahkeluar'])) {
        echo "
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Jumlah produk keluar kosong!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              });
            });
          </script>";
    } else {
        if (tambahProductkeluar($_POST) > 0) {
            echo "
              <script>
                document.addEventListener('DOMContentLoaded', function () {
                  Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Data product keluar berhasil ditambahkan!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                  }).then((swipe)=>{
                    window.location.href = '../page/page-product-keluar.php';
                  })
                });
              </script>";
        }
    }
}

// todo fungsi hapus produdct 
if (isset($_GET['id_product'])) {
    $id_product = $_GET['id_product'];
    if (hapusProductkeluar($id_product) > 0) {
        echo "
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data product keluar berhasil dihapus!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              }).then((swipe)=>{
                window.location.href = '../page/page-product-keluar.php';
              })
            });
          </script>";
    }
}

// todo fungsi menampilkan all tb_product  tb_product keluar
$select_data = "SELECT * FROM tb_product";
$query_data = mysqli_query($connection_database, $select_data);

// todo fungsi untuk menampilkan data hari ini 
$select_data_hari_ini = "SELECT tb_product_keluar.id_product, 
                                 tb_product.nama_product, 
                                 SUM(tb_product_keluar.jumlah_keluar) as total_jumlah_keluar
                         FROM tb_product_keluar
                         JOIN tb_product ON tb_product_keluar.id_product = tb_product.id_product
                         WHERE DATE(tanggal_keluar) = CURDATE()
                         GROUP BY tb_product_keluar.id_product";

$query_sdhi = mysqli_query($connection_database, $select_data_hari_ini);

// todo fungsi menampilkan data hari kemarin
$select_data_hari_kemarin = "SELECT tb_product_keluar.id_product, 
                                   tb_product.nama_product, 
                                   SUM(tb_product_keluar.jumlah_keluar) as total_jumlah_keluar
                             FROM tb_product_keluar
                             JOIN tb_product ON tb_product_keluar.id_product = tb_product.id_product
                             WHERE DATE(tanggal_keluar) = CURDATE() - 1
                             GROUP BY tb_product_keluar.id_product";
$query_sdhk = mysqli_query($connection_database, $select_data_hari_kemarin);

// todo fungsi menampilkan data minggu ini
$select_data_minggu_ini = "SELECT tb_product_keluar.id_product, 
                                   tb_product.nama_product, 
                                   SUM(tb_product_keluar.jumlah_keluar) as total_jumlah_keluar
                            FROM tb_product_keluar
                            JOIN tb_product ON tb_product_keluar.id_product = tb_product.id_product
                            WHERE WEEK(tanggal_keluar) = WEEK(CURDATE())
                            GROUP BY tb_product_keluar.id_product";
$query_sdmgi = mysqli_query($connection_database, $select_data_minggu_ini);

// todo fungsi menampilkan data bulan ini
$select_data_bulan_ini = "SELECT tb_product_keluar.id_product, 
                                  tb_product.nama_product, 
                                  SUM(tb_product_keluar.jumlah_keluar) as total_jumlah_keluar
                           FROM tb_product_keluar
                           JOIN tb_product ON tb_product_keluar.id_product = tb_product.id_product
                           WHERE MONTH(tanggal_keluar) = MONTH(CURDATE())
                           GROUP BY tb_product_keluar.id_product";
$query_sdbmi = mysqli_query($connection_database, $select_data_bulan_ini);

// todo fungsi untuk generate hari bahasa inggris ke indonesia 
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
    // Mengembalikan nama hari yang sudah dikonversi
    return $namaHari[$hari];
}
// Mengonversi dan menampilkan nama hari dalam bahasa Indonesia
$hariInggris = date('D');
$hariIndonesia = konversiHari($hariInggris);

// konversi nema hari kemarin bahasa indo 
$hariKemarin = date('D', strtotime('-1 day'));
$hariKemarinResult = konversiHari($hariKemarin);
?>

<body class="w-full h-h-100%">
    <div class="container w-full p-4">

        <!-- untuk btn kembali  dan judul -->
        <div class="w-full flex items-center justify-between">
            <!-- untuk btn kembali  -->
            <div onclick="window.location.href='../dsb-halaman-product.php'" class="btn-kembali w-fit cursor-pointer p-2 rounded-md flex items-center hover:bg-gray-1">
                <img class="w-8" src="../svg/arrow-small-left 1.svg" alt="">
                <p class="capitalize font-poppins font-poppins-500 text-normales">kembali</p>
            </div>
            <!-- untuk judul  -->
            <div>
                <h1 class="text-high font-poppins-600 capitalize">Product keluar</h1>
            </div>
        </div>

        <!-- untuk btn tambah product  -->
        <div class="w-fit mt-4">
            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap" class="flex items-center gap-gap-10px bg-blue-2 p-4 justify-between rounded-[30px]">
                <p class="p-2 rounded-full text-normales text-blue-700 font-poppins-600 bg-white">add</p>
                <p class="text-white font-poppins text-normales">Tambah product keluar</p>
                <img class="w-10 p-2 bg-blue-trans-1 rounded-full" src="../svg/angle-small-right (1) 1.svg" alt="">
            </button>
        </div>

        <!-- untuk isi data product dari tanggal hari ini, kemarin, minggu ini dan bulan ini  -->
        <div class="w-full">
            <!-- tanggal hari ini  -->
            <div class="w-full mt-4 p-4 shadow-box-shadow-1 rounded-[10px]">
                <h1>Product keluar Hari ini - <strong><?= $hariIndonesia ?></strong></h1>
                <!-- untuk isi data  -->
                <?php if (mysqli_num_rows($query_sdhi) > 0) : ?>
                    <div class="w-full grid grid-cols-4 gap-gap-10px">
                        <!-- content card  -->
                        <?php while ($data = mysqli_fetch_assoc($query_sdhi)) : ?>
                            <div class="mt-4 p-4 w-full shadow-box-shadow-2 hover:shadow-box-shadow-3 rounded-[10px] transition-all duration-300 ease-out">
                                <form action="" method="post">
                                    <input type="hidden" value="<?= $data['id_product'] ?>" name="idproductkeluar">
                                </form>
                                <div class="header text-high font-poppins-600 capitalize"><?= $data['nama_product'] ?></div>
                                <div class="body text-normales font-poppins-500">keluar : <?= $data['total_jumlah_keluar'] ?>pcs</div>
                                <div class="flex w-full justify-end gap-gap-10px">
                                    <img onclick="hapusProductkeluar('<?= $data['id_product'] ?>')" type="button" class="w-5 cursor-pointer object-contain" src="../svg/trash.svg" alt="">
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else : ?>
                    <div class="w-full flex justify-center"><img class="w-48" src="https://i.imgur.com/PMWXNEc.png" alt=""></div>
                <?php endif; ?>
            </div>
            <!-- tanggal kemarin  -->
            <div class=" mt-4 p-4 shadow-box-shadow-1 rounded-[10px]">
                <h1>Product keluar Hari kemarin - <strong><?= $hariKemarin ?></strong></h1>
                <!-- untuk isi data  -->
                <?php if (mysqli_num_rows($query_sdhk) > 0) : ?>
                    <div class="w-full grid grid-cols-4 gap-gap-10px">
                        <!-- content card  -->
                        <?php while ($data = mysqli_fetch_assoc($query_sdhk)) : ?>
                            <div class="mt-4 p-4 w-full shadow-box-shadow-2 hover:shadow-box-shadow-3 rounded-[10px] transition-all duration-300 ease-out">
                                <form action="" method="post">
                                    <input type="hidden" value="<?= $data['id_product'] ?>" name="idproductkeluar">
                                </form>
                                <div class="header text-high font-poppins-600 capitalize"><?php echo $data['nama_product'] ?></div>
                                <div class="body text-normales font-poppins-500">keluar : <?php echo $data['total_jumlah_keluar'] ?>pcs</div>
                                <div class="flex w-full justify-end gap-gap-10px">
                                    <img onclick="hapusProductkeluar('<?= $data['id_product'] ?>')" type="button" class="w-5 cursor-pointer object-contain" src="../svg/trash.svg" alt="">
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else : ?>
                    <div class="w-full flex justify-center"><img class="w-48" src="https://i.imgur.com/PMWXNEc.png" alt=""></div>
                <?php endif; ?>
            </div>
            <!-- tanggal minggu ini  -->
            <div class=" mt-4 p-4 shadow-box-shadow-1 rounded-[10px]">
                <h1>Product keluar minggu ini</h1>
                <!-- untuk isi data  -->
                <?php if (mysqli_num_rows($query_sdmgi) > 0) : ?>
                    <div class="w-full grid grid-cols-4 gap-gap-10px">
                        <!-- content card  -->
                        <?php while ($data = mysqli_fetch_assoc($query_sdmgi)) : ?>
                            <div class="mt-4 p-4 w-full shadow-box-shadow-2 hover:shadow-box-shadow-3 rounded-[10px] transition-all duration-300 ease-out">
                                <form action="" method="post">
                                    <input type="hidden" value="<?= $data['id_product'] ?>" name="idproductkeluar">
                                </form>
                                <div class="header text-high font-poppins-600 capitalize"><?php echo $data['nama_product'] ?></div>
                                <div class="body text-normales font-poppins-500">keluar : <?php echo $data['total_jumlah_keluar'] ?>pcs</div>
                                <div class="flex w-full justify-end gap-gap-10px">
                                    <img onclick="hapusProductkeluar('<?= $data['id_product'] ?>')" type="button" class="w-5 cursor-pointer object-contain" src="../svg/trash.svg" alt="">
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else : ?>
                    <div class="w-full flex justify-center"><img class="w-48" src="https://i.imgur.com/PMWXNEc.png" alt=""></div>
                <?php endif; ?>
            </div>
            <!-- tanggal bulan ini  -->
            <div class=" mt-4 p-4 shadow-box-shadow-1 rounded-[10px]">
                <h1>Product keluar bulan ini</h1>
                <!-- untuk isi data  -->
                <?php if (mysqli_num_rows($query_sdbmi) > 0) : ?>
                    <div class="w-full  grid grid-cols-4 gap-gap-10px">
                        <!-- content card  -->
                        <?php while ($data = mysqli_fetch_assoc($query_sdbmi)) : ?>
                            <div class="mt-4 p-4 w-full shadow-box-shadow-2 hover:shadow-box-shadow-3 rounded-[10px] transition-all duration-300 ease-out">
                                <form action="" method="post">
                                    <input type="hidden" value="<?= $data['id_product'] ?>" name="idproductkeluar">
                                </form>
                                <div class="header text-high font-poppins-600 capitalize"><?php echo $data['nama_product'] ?></div>
                                <div class="body text-normales font-poppins-500">keluar : <?php echo $data['total_jumlah_keluar'] ?>pcs</div>
                                <div class="flex w-full justify-end gap-gap-10px">
                                    <img onclick="hapusProductkeluar('<?= $data['id_product'] ?>')" type="button" class="w-5 cursor-pointer object-contain" src="../svg/trash.svg" alt="">
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else : ?>
                    <div class="w-full flex justify-center"><img class="w-48" src="https://i.imgur.com/PMWXNEc.png" alt=""></div>
                <?php endif; ?>
            </div>
        </div>

        <!-- untuk modals input isnert -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="font-poppins-600 text-high capitalize" id="exampleModalLabel">Tambah Product keluar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="namaproduct" class="col-form-label">Nama Product</label>
                                <select class="w-full p-2 rounded-md" name="namaproduct" id="namaproduct">
                                    <?php while ($data = mysqli_fetch_assoc($query_data)) : ?>
                                        <option value="<?php echo $data['id_product'] ?>"><?php echo $data['nama_product'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Jumlah keluar</label>
                                <input type="number" class="form-control" id="message-text" name="jumlahkeluar">
                            </div>
                            <div class="w-full flex justify-end gap-gap-10px">
                                <button type="submit" name="submit" class="text-white btn bg-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        function hapusProductkeluar(id) {
            Swal.fire({
                title: 'Hapus?',
                text: "Yakin ingin menghapus data ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'page-product-keluar.php?id_product=' + id;
                }
            })
        };
    </script>
</body>

</html>