<?php
require '../function/connection.php';
$SELECT_DATA = "SELECT * FROM tb_client WHERE status_client = 'Aktif'";
$RESULT_DATA = mysqli_query($connection_database, $SELECT_DATA);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=s, initial-scale=1.0">
    <link rel="stylesheet" href="../css/all.css" />
    <link rel="icon" type="image/x-icon" href="../ico/dapnetwork.ico" />
    <link rel="stylesheet" href="../css/card-daftaclient-penagihan.css" />
    <link rel="stylesheet" href="../css/page-penagihan.css" />
    <link rel="stylesheet" href="../dist/output.css" />
    <title>Penagihan - DAPNETWORK</title>
</head>

<body>
    <div class="container-page-penagihan">
        <div class="btnkembali-heading">
            <div class="btnkembali" onclick="window.location.href='../dsb-halaman-client.php'">
                <img src="../svg/angle-small-right 1.svg" alt="icon arrow">
                <p>Kembali</p>
            </div>
            <div class="heading">Client Aktif</div>
        </div>
        <?php if (mysqli_num_rows($RESULT_DATA) > 0) : ?>
            <?php include '../components/card/card-daftarclient-aktif.php' ?>
        <?php else : ?>
            <div class="container-nodata flex justify-center mt-4">
                <img class="w-96 object-cover" src="https://i.ibb.co/wNW9XhJ/404-error-with-people-holding-the-numbers-rafiki.png" alt="">
            </div>
        <?php endif ?>
    </div>
</body>

</html>