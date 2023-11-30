<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/all.css"/>
    <link rel="stylesheet" href="../css/page-profile.css"/>
    <title>Profile - Admin</title>
</head>
<?php 
require '../function/connection.php';

// todo menampilkan data pegawai admin 
$nama_awal = $_GET['user'];
$QUERY = "SELECT * FROM tb_pegawai WHERE nama_awal = '$nama_awal'";
$QUERY = mysqli_query($connection_database, $QUERY);
$row = mysqli_fetch_assoc($QUERY);

?>
<body>
    <div class="container-page-profile">
        <div class="wrapper-content-profile">
            <div class="component1">
                <div class="image">
                    <img src="../images/<?= $row['foto_pegawai'] ?>" alt="327979180-720697956118615-8277811980532964440-n" alt="">
                </div>
                <div class="namalengkap"><?= $row['nama_awal'] ?> <?= $row['nama_akhir']?></div>
                <div class="email"><?= $row['email'] ?></div>
                <div class="jabatan"><?= $row['jabatan'] ?></div>
                <div class="btn-edit"><a href="page-update-profile.php?nama_awal=<?= $row['nama_awal'] ?>">Edit Profile</a></div>
            </div>
            <div class="component2">
                <div class="table">
                    <table>
                        <tr>
                            <th>NIK</th>
                            <td>:</td>
                            <td><?= $row['nik'] ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>:</td>
                            <td><?= $row['jenis_kelamin'] ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>:</td>
                            <td><?= date("j F Y", strtotime($row['tanggal_lahir'])) ?></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>:</td>
                            <td><?= $row['alamat'] ?></td>
                        </tr>
                        <tr>
                            <th>Nomor Telfon</th>
                            <td>:</td>
                            <td>08987654321</td>
                        </tr>
                        <tr>
                            <th>Gaji</th>
                            <td>:</td>
                            <td>Rp. 1.000.000</td>
                        </tr>
                        <tr>
                            <th>Tanggal Masuk</th>
                            <td>:</td>
                            <td>01 Januari 2021</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>:</td>
                            <td>Aktif</td>
                        </tr>
                        <tr>
                            <th>Hak akses</th>
                            <td>:</td>
                            <td>Admin</td>
                        </tr>
                        <tr>
                            <th>Agama</th>
                            <td>:</td>
                            <td>Islam</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>