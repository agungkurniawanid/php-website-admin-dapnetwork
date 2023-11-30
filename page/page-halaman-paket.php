<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<?php
require 'function/connection.php';
$SELECT_PAKET = mysqli_query($connection_database,"SELECT * FROM tb_paket_layanan ORDER BY harga ASC"); 

$total_paket = mysqli_query($connection_database, "SELECT COUNT(*) AS total_paket FROM tb_paket_layanan");
$total_paket_row = mysqli_fetch_assoc($total_paket);
$total_paket_result = $total_paket_row['total_paket'];
?>

<body>
    <div class="wrapper-page-halaman-paket">
        <div class="wrapper-table-search-paket">
            <div class="wrapper-tomboltambah-search">
                <div class="tomboltambah">
                    <button id="tambah-paket">Tambah Paket</button>
                </div>
                <div class="search">
                    <label for="search"><img src="svg/search.svg" alt="icon search" /></label>
                    <input type="text" oninput="cariPaket(this.value)" name="search" id="search" placeholder="Cari paket" />
                </div>
            </div>
            <div class="table">
                <table>
                    <thead> 
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Jenis Paket</th>
                            <th>Harga</th>
                            <th>Dekripsi</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nopegawai = 1; ?>
                        <?php foreach($SELECT_PAKET as $paket) :  ?>
                        <tr>
                            <td><?php echo $nopegawai;
                                $nopegawai++; ?></td>
                            <td><?php echo $paket['id_paket_layanan']; ?></td>
                            <td><?php echo $paket['jenis_paket_layanan']; ?></td>
                            <td><?php echo $paket['harga']; ?></td>
                            <td><?php echo $paket['deskripsi_paket_layanan']; ?></td>
                            <td style="text-align: center;"><a href="page/page-update-paket.php?id_paket_layanan=<?php echo $paket['id_paket_layanan']; ?>" class="update-halaman-pegawai"><img src="svg/edit.svg" alt="" class="tbl-aksi-pegawai"></a></td>
                            <td style="text-align: center;"><a href="#" onclick="confirmHapusPaket('<?php echo $paket['id_paket_layanan']; ?>')" class="hapus-halaman-pegawai"><img src="svg/trash.svg" alt="" class="tbl-aksi-pegawai"></a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="nextdata-jumlahclient">
                <div>Jumlah paket : <?php echo $total_paket_result; ?>  Paket</div>
            </div>
        </div>
    </div>
    <script>
         function cariPaket(keyword) {
            $.ajax({
                type: 'POST',
                url: 'function/cari-paket.php', // Sesuaikan dengan nama file yang tepat
                data: {
                    keyword: keyword
                },
                success: function(data) {
                    $('.table tbody').html(data);
                }
            });
        }

        function confirmHapusPaket(id) {
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
                    window.location.href = '?id_paket_layanan=' + id;
                }
            });
        }
    </script>
    <?php 
    require 'function/hapus-paket.php';
    if (isset($_GET["id_paket_layanan"])) {
        $id = $_GET["id_paket_layanan"];
        if(HAPUSPAKET($id) > 0) {
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