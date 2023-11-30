<?php
require 'function/connection.php';
require 'function/delete-pegawai.php';
$SELECT_PEGAWAI = mysqli_query($connection_database, "SELECT * FROM tb_pegawai WHERE hak_akses_pegawai = 'Teknisi' ORDER BY id_pegawai ASC");
$USER_LOGIN_HARI_INI = mysqli_query($connection_database, "SELECT * FROM tb_catatan_login 
    JOIN tb_pegawai ON tb_catatan_login.id_pegawai = tb_pegawai.id_pegawai 
    WHERE DATE(tb_catatan_login.tanggal_login) = CURDATE() GROUP BY tb_catatan_login.id_pegawai");

$USER_LOGIN_KEMARIN = mysqli_query($connection_database, "SELECT * FROM tb_catatan_login 
    JOIN tb_pegawai ON tb_catatan_login.id_pegawai = tb_pegawai.id_pegawai 
    WHERE DATE(tb_catatan_login.tanggal_login) = CURDATE() - INTERVAL 1 DAY
    GROUP BY tb_catatan_login.id_pegawai");


$total_pegawai = mysqli_query($connection_database, "SELECT COUNT(*) AS total_pegawai FROM tb_pegawai");
$total_pegawai_row = mysqli_fetch_assoc($total_pegawai);
$total_pegawai_result = $total_pegawai_row['total_pegawai'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="wrapper-page-halaman-pegawai">
        <div class="wrapper-table-search-pegawai">
            <div class="wrapper-tomboltambah-search">
                <div class="tomboltambah">
                    <button id="tambah-client">Tambah Pegawai</button>
                </div>
                <div class="search">
                    <label for="search"><img src="svg/search.svg" alt="icon search" /></label>
                    <input type="text" oninput="cariPegawai(this.value)" name="search" id="search" placeholder="Cari pegawai" />
                </div>
            </div>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th></th>
                            <th>Nama Lengkap</th>
                            <th>Identity Card</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat Lengkap</th>
                            <th>Nomor Telfon</th>
                            <th>Jabatan</th>
                            <th>Gaji</th>
                            <th>Status</th>
                            <th>Hak Akses</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nopegawai = 1; ?>
                        <?php foreach ($SELECT_PEGAWAI as $pegawai) : ?>
                            <tr>
                                <td><?php echo $nopegawai;
                                    $nopegawai++; ?></td>
                                <td><img src="./images/<?= $pegawai['foto_pegawai'] ?>" alt="" class="img-pegawai"></td>
                                <td><?= $pegawai['nama_awal'] . ' ' . $pegawai['nama_akhir'] ?></td>
                                <td><?= $pegawai['id_pegawai'] ?></td>
                                <td><?= $pegawai['jenis_kelamin'] ?></td>
                                <td><?= $pegawai['alamat'] ?></td>
                                <td><?= $pegawai['nomor_telepon'] ?></td>
                                <td><?= $pegawai['jabatan'] ?></td>
                                <td><?= $pegawai['gaji'] ?></td>
                                <td><?= $pegawai['status'] ?></td>
                                <td><?= $pegawai['hak_akses_pegawai'] ?></td>
                                <td><a href="page/page-update-pegawai.php?id_pegawai=<?= $pegawai['id_pegawai'] ?>" class="update-halaman-pegawai"><img src="svg/edit.svg" alt="" class="tbl-aksi-pegawai"></a></td>
                                <td><a href="#" onclick="confirmDeleteHalamanPegawai('<?php echo $pegawai['id_pegawai'] ?>')" class="hapus-halaman-pegawai"><img src="svg/trash.svg" alt="" class="tbl-aksi-pegawai"></a></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="nextdata-jumlahclient">
                <div>Jumlah pegawai : <?php echo $total_pegawai_result ?> Orang</div>
            </div>
        </div>
        <div class="wrapper-daftar-pegawai-login">
            <div class="heading">
                <span>Pegawai Login</span>
            </div>
            <div class="body">
                <div class="login-hari-ini">
                    <p>Pegawai Login Hari Ini</p>
                    <div class="container-card">
                        <?php if (mysqli_num_rows($USER_LOGIN_HARI_INI) > 0) : ?>
                            <?php foreach ($USER_LOGIN_HARI_INI as $item) : ?>
                                <div class="wrapper-card">
                                    <div class="image"><img src="images/<?= $item['foto_pegawai'] ?>" alt=""></div>
                                    <div class="name-title">
                                        <div class="name"><?= $item['nama_awal'] . ' ' . $item['nama_akhir'] ?></div>
                                        <div class="email"><?= $item['email'] ?></div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php else : ?>
                            <p>Tidak ada data</p>
                        <?php endif ?>
                    </div>
                </div>
                <div class="login-hari-ini kemarinbro">
                    <p>Pegawai Login Kemarin</p>
                    <div class="container-card">
                        <?php if (mysqli_num_rows($USER_LOGIN_KEMARIN) > 0) : ?>
                            <?php foreach ($USER_LOGIN_KEMARIN as $item) : ?>
                                <div class="wrapper-card">
                                    <div class="image"><img src="images/<?= $item['foto_pegawai'] ?>" alt=""></div>
                                    <div class="name-title">
                                        <div class="name"><?= $item['nama_awal'] . ' ' . $item['nama_akhir'] ?></div>
                                        <div class="email"><?= $item['email'] ?></div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php else : ?>
                            <p style="color: blue;">Tidak ada data</p>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
           function cariPegawai(keyword) {
            $.ajax({
                type: 'POST',
                url: 'function/cari-pegawai.php', // Sesuaikan dengan nama file yang tepat
                data: {
                    keyword: keyword
                },
                success: function(data) {
                    $('.table tbody').html(data);
                }
            });
        }

        function confirmDeleteHalamanPegawai(id) {
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
                    window.location.href = '?id_pegawai=' + id;
                }
            });
        }
    </script>
    <?php
    if (isset($_GET["id_pegawai"])) {
        $id = $_GET["id_pegawai"];
        $affected_rows = hapus_pegawai($id);
        if ($affected_rows > 0) {
            echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil dihapus.',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                </script>
                ";
        }
    }
    ?>
</body>

</html>