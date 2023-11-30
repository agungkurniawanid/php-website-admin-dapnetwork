<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/all.css" />
    <link rel="stylesheet" href="../css/page-update-pengeluaran.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Update Pemasukan</title>
</head>

<?php 
require '../function/connection.php';
require '../function/update-pengeluaran.php';

if(isset($_POST['update'])) {
    if(updatePengeluaran($_POST) > 0) {
        echo "
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'success',
                        title: 'Selamat...',
                        text: 'Pemasukan berhasil diupdate',
                        timer: 1000,
                        showConfirmButton: false,
                    }).then(function (result) {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            window.location.href='../dsb-halaman-pengeluaran.php';
                        }
                    });
                });
            </script>
        ";
    }
}

// todo select tb_pemasukan 
$id = $_GET['update-pengeluaran'];
$SELECT_TB_PEMASUKAN = "SELECT * FROM tb_pengeluaran WHERE id_pengeluaran = '$id'";
$SELECT_TB_PEMASUKAN_RESULT = mysqli_query($connection_database, $SELECT_TB_PEMASUKAN);
$SELECT_TB_PEMASUKAN_ROW = mysqli_fetch_assoc($SELECT_TB_PEMASUKAN_RESULT);
?>

<body>
    <div class="container">
        <div class="btn-kembali" onclick="window.location.href='../dsb-halaman-pengeluaran.php'">
            <img src="../svg/arrow-small-left 1.svg" alt="back">
            <p>Kembali</p>
        </div>
        <div class="login-box">
            <form action="" method="post">
                <input type="hidden" name="idpengeluaran" value="<?= $_GET['update-pengeluaran'] ?>">
                <div class="user-box">
                    <input type="text" name="kategoripengeluaran" value="<?= $SELECT_TB_PEMASUKAN_ROW['kategori_pengeluaran'] ?>"">
                    <label>Kategori Pengeluaran</label>
                </div>
                <div class="user-box">
                    <input type="text" name="deskripsipengeluaran" value="<?= $SELECT_TB_PEMASUKAN_ROW['deskripsi_pengeluaran'] ?>"">
                    <label>Deskripsi Pengeluaran</label>
                </div>
                <div class="user-box">
                    <input type="number" name="jumlahnominal" value="<?= $SELECT_TB_PEMASUKAN_ROW['jumlah_nominal'] ?>">
                    <label>Nominal Pengeluaran</label>
                </div>
                <button type="submit" name="update">
                    <p>
                        Simpan Perubahan
                        <span></span>
                    </p>
                </button>
            </form>
        </div>
    </div>
</body>

</html>