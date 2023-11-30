<?php
require 'connection.php';

if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];

    $query = "SELECT * FROM tb_pemasukan 
              WHERE tanggal_pemasukan LIKE '%$keyword%' OR jumlah_nominal LIKE '%$keyword%'";
    
    $result = mysqli_query($connection_database, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $No = 1; // Ubah dari $nopaket menjadi $No
            while ($pemasukan = mysqli_fetch_assoc($result)) {
                echo "<tr>
                <td>$No</td>
                <td>{$pemasukan['id_pemasukan']}</td>
                <td>" . date('d F Y', strtotime($pemasukan['tanggal_pemasukan'])) . "</td>
                <td>{$pemasukan['sumber_pemasukan']}</td>
                <td>{$pemasukan['deskripsi_pemasukan']}</td>
                <td>Rp. " . number_format($pemasukan['jumlah_nominal'], 0, ',', '.') . "</td>
                <td><a href='page/page-update-pemasukan.php?update-pemasukan={$pemasukan['id_pemasukan']}'><img src='svg/edit.svg' alt=''></a></td>
                <td><a href='#' onclick='hapusPemasukan(\"{$pemasukan['id_pemasukan']}\")'><img src='svg/trash.svg' alt=''></a></td>
            </tr>";
                $No++;
            }
        } else {
            echo "<tr><td colspan='7'>Data tidak ditemukan</td></tr>";
        }
    } else {
        echo "Error: " . mysqli_error($connection_database);
    }
}
?>
