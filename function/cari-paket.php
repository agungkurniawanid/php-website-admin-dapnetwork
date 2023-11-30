<?php
require 'connection.php';

if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];

    $query = "SELECT * FROM tb_paket_layanan 
              WHERE jenis_paket_layanan LIKE '%$keyword%' OR harga LIKE '%$keyword%'";
    
    $result = mysqli_query($connection_database, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $nopaket = 1;
            while ($paket = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$nopaket}</td>
                        <td>{$paket['id_paket_layanan']}</td>
                        <td>{$paket['jenis_paket_layanan']}</td>
                        <td>{$paket['harga']}</td>
                        <td>{$paket['deskripsi_paket_layanan']}</td>
                        <td style='text-align: center;'><a href='page/page-update-paket.php?id_paket_layanan={$paket['id_paket_layanan']}' class='update-halaman-pegawai'><img src='svg/edit.svg' alt='' class='tbl-aksi-pegawai'></a></td>
                        <td style='text-align: center;'><a href='#' onclick='confirmHapusPaket(\"{$paket['id_paket_layanan']}\")' class='hapus-halaman-pegawai'><img src='svg/trash.svg' alt='' class='tbl-aksi-pegawai'></a></td>
                    </tr>";
                $nopaket++;
            }
        } else {
            echo "<tr><td colspan='7'>Data tidak ditemukan</td></tr>";
        }
    } else {
        echo "Error: " . mysqli_error($connection_database);
    }
}
?>
