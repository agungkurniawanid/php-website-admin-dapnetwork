<?php
require 'function/connection.php';
require 'function/delete-client.php';

// Menampilkan data
$select_user = mysqli_query($connection_database, "SELECT * FROM tb_client ORDER BY nama_client ASC");

// Menampilkan jumlah data count
$total_user = mysqli_query($connection_database, "SELECT COUNT(*) AS total_client FROM tb_client");
$total_user_row = mysqli_fetch_assoc($total_user);
$total_user_client = $total_user_row['total_client'];

// Cari client
if (isset($_POST['cari'])) {
    $keyword = $_POST['keyword'];
    $select_user = mysqli_query($connection_database, "SELECT * FROM tb_client WHERE nama_client LIKE '%$keyword%' OR alamat LIKE '%$keyword%'");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/page-halaman-client.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
    <div class="wrapper-halaman-client">
        <div class="component1">
            <div class="daftar-informasi">daftar informasi</div>
            <img src="svg/angle-circle-right.svg" alt="" id="swipeleft" class="swipe" />
            <?php include 'components/card/card-daftar-informasi-halaman-client.php' ?>
            <img src="svg/angle-circle-right.svg" alt="" id="swiperight" class="swipe" />
        </div>
        <div class="component2">
            <div class="wrapper-tomboltambah-search">
                <div class="tomboltambah">
                    <button id="tambah-client">Tambah client</button>
                </div>
                <div class="search">
                    <label for="search"><img src="svg/search.svg" alt="icon search" /></label>
                    <input type="text" name="search" id="search" placeholder="Cari client" oninput="cariClient(this.value)" />
                </div>
            </div>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Gender</th>
                            <th>Alamat</th>
                            <th>Nomor</th>
                            <th>Email</th>
                            <th>Tanggal Masuk</th>
                            <th>Foto</th>
                            <th>Status</th>
                            <th>Update</th>
                            <th>Hapus</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nolcient = 1; ?>
                        <?php foreach ($select_user as $client) : ?>
                            <tr>
                                <td><?php echo $nolcient;
                                    $nolcient++; ?></td>
                                <td><?php echo $client['id_client'] ?></td>
                                <td><?php echo $client['nama_client'] ?></td>
                                <td><?php echo $client['jenis_kelamin'] ?></td>
                                <td><?php echo $client['alamat'] ?></td>
                                <td><?php echo $client['nomor_telepon'] ?></td>
                                <td><?php echo $client['email'] ?></td>
                                <td><?php echo $client['tanggal_masuk'] ?></td>
                                <td>
                                    <?php $foto_path = $client['foto_client']; ?>
                                    <img src="<?php echo './images/' . $foto_path; ?>" alt="foto client" class="img-client"/>
                                </td>
                                <td><?php echo $client['status_client'] ?></td>
                                <td><a href="page/page-update-client.php?id_client=<?= $client['id_client'] ?>&nama_client=<?= $client['nama_client'] ?>&jenis_kelamin=<?= $client['jenis_kelamin'] ?>&alamat=<?= $client['alamat'] ?>&nomor_telepon=<?= $client['nomor_telepon'] ?>&email=<?= $client['email'] ?>&tanggal_masuk=<?= $client['tanggal_masuk'] ?>&foto_client=<?= $client['foto_client'] ?>&status_client=<?= $client['status_client'] ?>" class="update-halaman-client"><img src="svg/edit.svg" alt="" class="tbl-aksi-client"></a></td>
                                <td><a href="#" onclick="confirmDeleteHalamanClient('<?php echo $client['id_client'] ?>')" class="hapus-halaman-client"><img src="svg/trash.svg" alt="" class="tbl-aksi-client"></a></td>
                                <td><a href="page/page-detail-client.php?id_client=<?= $client['id_client'] ?>" class="detail-halaman-client"><img src="svg/file-circle-info.svg" alt="" class="tbl-aksi-client"></a></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="nextdata-jumlahclient">
                <div>Jumlah client : <?php echo $total_user_client ?> Orang</div>
            </div>
        </div>
    </div>
    <script>
        function cariClient(keyword) {
            $.ajax({
                type: 'POST',
                url: 'function/cari-client.php', // Sesuaikan dengan nama file yang tepat
                data: {
                    keyword: keyword
                },
                success: function(data) {
                    $('.table tbody').html(data);
                }
            });
        }

        function confirmDeleteHalamanClient(id) {
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
                    window.location.href = '?id_client=' + id;
                }
            });
        }
    </script>
    <?php
    if (isset($_GET["id_client"])) {
        $id = $_GET["id_client"];
        $affected_rows = hapus_client($id);
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
    <script src="js/page-halaman-client.js"></script>
</body>

</html>