<?php
require 'connection.php';

if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];

    $query = "SELECT * FROM tb_client WHERE nama_client LIKE '%$keyword%' OR alamat LIKE '%$keyword%'";
    $result = mysqli_query($connection_database, $query);

    if (mysqli_num_rows($result) > 0) {
        $nolcient = 1;
        while ($client = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>$nolcient</td>
                    <td>{$client['id_client']}</td>
                    <td>{$client['nama_client']}</td>
                    <td>{$client['jenis_kelamin']}</td>
                    <td>{$client['alamat']}</td>
                    <td>{$client['nomor_telepon']}</td>
                    <td>{$client['email']}</td>
                    <td>{$client['tanggal_masuk']}</td>
                    <td><img src='./images/{$client['foto_client']}' alt='foto client' /></td>
                    <td>{$client['status_client']}</td>
                    <td><a href='page/page-update-client.php?id_client={$client['id_client']}&nama_client={$client['nama_client']}&jenis_kelamin={$client['jenis_kelamin']}&alamat={$client['alamat']}&nomor_telepon={$client['nomor_telepon']}&email={$client['email']}&tanggal_masuk={$client['tanggal_masuk']}&foto_client={$client['foto_client']}&status_client={$client['status_client']}' class='update-halaman-client'><img src='svg/edit.svg' alt='' class='tbl-aksi-client'></a></td>
                    <td><a href='#' onclick=\"confirmDeleteHalamanClient('{$client['id_client']}')\" class='hapus-halaman-client'><img src='svg/trash.svg' alt='' class='tbl-aksi-client'></a></td>
                    <td><a href='page/page-detail-client.php?id_client={$client['id_client']}' class='detail-halaman-client'><img src='svg/file-circle-info.svg' alt='' class='tbl-aksi-client'></a></td>
                  </tr>";
            $nolcient++;
        }
    } else {
        echo "<tr><td colspan='13'>Data tidak ditemukan</td></tr>";
    }
}
?>