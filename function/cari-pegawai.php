<?php
require 'connection.php';

if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];

    $query = "SELECT * FROM tb_pegawai 
              WHERE (nama_awal LIKE '%$keyword%' OR nama_akhir LIKE '%$keyword%' OR alamat LIKE '%$keyword%') 
              AND hak_akses_pegawai = 'Teknisi'";
    
    $result = mysqli_query($connection_database, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $nopegawai = 1;
            while ($pegawai = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$nopegawai}</td>
                        <td><img src='./images/{$pegawai['foto_pegawai']}' alt='' class='img-pegawai'></td>
                        <td>{$pegawai['nama_awal']} {$pegawai['nama_akhir']}</td>
                        <td>{$pegawai['id_pegawai']}</td>
                        <td>{$pegawai['jenis_kelamin']}</td>
                        <td>{$pegawai['alamat']}</td>
                        <td>{$pegawai['nomor_telepon']}</td>
                        <td>{$pegawai['jabatan']}</td>
                        <td>{$pegawai['gaji']}</td>
                        <td>{$pegawai['status']}</td>
                        <td>{$pegawai['hak_akses_pegawai']}</td>
                        <td><a href='page/page-update-pegawai.php?id_pegawai={$pegawai['id_pegawai']}' class='update-halaman-pegawai'><img src='svg/edit.svg' alt='' class='tbl-aksi-pegawai'></a></td>
                        <td><a href='#' onclick='confirmDeleteHalamanPegawai(\"{$pegawai['id_pegawai']}\")' class='hapus-halaman-pegawai'><img src='svg/trash.svg' alt='' class='tbl-aksi-pegawai'></a></td>
                        <td><a href='#' class='detail-halaman-pegawai'><img src='svg/file-circle-info.svg' alt='' class='tbl-aksi-pegawai'></a></td>
                    </tr>";
                $nopegawai++;
            }
        } else {
            echo "<tr><td colspan='13'>Data tidak ditemukan</td></tr>";
        }
    } else {
        echo "Error: " . mysqli_error($connection_database);
    }
}
?>
