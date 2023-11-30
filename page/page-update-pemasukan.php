<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/all.css" />
    <link rel="stylesheet" href="../css/page-update-pemasukan.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Update Pemasukan</title>
</head>

<?php 
require '../function/connection.php';
require '../function/update-pemasukan.php';

if(isset($_POST['update'])) {
    if(updatePemasukan($_POST) > 0) {
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
                            window.location.href='../dsb-halaman-pemasukan.php';
                        }
                    });
                });
            </script>
        ";
    }
}

// todo select tb_pemasukan 
$id = $_GET['update-pemasukan'];
$SELECT_TB_PEMASUKAN = "SELECT * FROM tb_pemasukan WHERE id_pemasukan = '$id'";
$SELECT_TB_PEMASUKAN_RESULT = mysqli_query($connection_database, $SELECT_TB_PEMASUKAN);
$SELECT_TB_PEMASUKAN_ROW = mysqli_fetch_assoc($SELECT_TB_PEMASUKAN_RESULT);
?>

<body>
    <div class="container">
        <div class="btn-kembali" onclick="window.location.href='../dsb-halaman-pemasukan.php'">
            <img src="../svg/arrow-small-left 1.svg" alt="back">
            <p>Kembali</p>
        </div>
        <div class="login-box">
            <form action="" method="post">
                <input type="hidden" name="idpemasukan" value="<?= $_GET['update-pemasukan'] ?>">
                <div class="user-box">
                    <select name="sumberpemasukan" id="sumberpemasukan">
                        <option value="Pendapatan Usaha" <?php if($SELECT_TB_PEMASUKAN_ROW['sumber_pemasukan'] == "Pendapatan Usaha") { echo "selected"; } ?>>Pendapatan Usaha</option>
                        <option value="Modal Usaha" <?php if($SELECT_TB_PEMASUKAN_ROW['sumber_pemasukan'] == "Modal Usaha") { echo "selected"; } ?>>Modal Usaha</option>
                    </select>
                </div>
                <div class="user-box">
                    <input type="text" name="deskripsipemasukan" value="<?= $SELECT_TB_PEMASUKAN_ROW['deskripsi_pemasukan'] ?>"">
                    <label>Deskripsi Pemasukan</label>
                </div>
                <div class="user-box">
                    <input type="number" name="jumlahnominal" value="<?= $SELECT_TB_PEMASUKAN_ROW['jumlah_nominal'] ?>">
                    <label>Nominal Pemasukan</label>
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