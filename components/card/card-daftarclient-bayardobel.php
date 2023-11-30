<?php
require '../function/connection.php';
$FECTH_DATA = "SELECT * FROM tb_client JOIN tb_pembayaran ON tb_pembayaran.id_client = tb_client.id_client WHERE tb_pembayaran.status_pembayaran = 'Bayar Double' AND MONTH(tb_pembayaran.tanggal_pembayaran) = MONTH(CURRENT_DATE())";
$QUERY = mysqli_query($connection_database, $FECTH_DATA);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container-card-penagihan">
        <?php foreach($QUERY as $row) : ?>
        <div class="wrapper-card-penagihan">
            <div class="imageclient-btndetail">
                <div><img src="../images/<?= $row['foto_client'] ?>" alt="image client"></div>
                <div class="btn-detail"><a href="page-detail-client.php?id_client=<?= $row['id_client'] ?>">Detail</a></div>
            </div>
            <div class="nama-jeniskelamin">
                <div class="nama"><?= $row['nama_client'] ?></div>
                <div class="jenis-kelamin"><?= $row['jenis_kelamin'] ?></div>
            </div>
            <div class="alamat">
                <p><?= $row['alamat'] ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</body>

</html>