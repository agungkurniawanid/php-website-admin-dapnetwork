<?php
require 'connection.php';

if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];

    $query = "SELECT * FROM tb_pengeluaran
              WHERE tanggal_pengeluaran LIKE '%$keyword%' OR jumlah_nominal LIKE '%$keyword%'";
    
    $result = mysqli_query($connection_database, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $No = 1; // Ubah dari $nopaket menjadi $No
            while ($data = mysqli_fetch_assoc($result)) {
                echo "   <tr>
                <td>{$No}</td>
                <td>{$data['id_pengeluaran']}</td>
                <td>" . date('d F Y', strtotime($data['tanggal_pengeluaran'])) . "</td>
                <td>{$data['kategori_pengeluaran']}</td>
                <td>{$data['deskripsi_pengeluaran']}</td>
                <td>Rp. " . number_format($data['jumlah_nominal'], 0, ',', '.') . "</td>
                <td><a href='page/page-update-pengeluaran.php?update-pengeluaran={$data['id_pengeluaran']}'><img src='svg/edit.svg' alt=''></a></td>
                <td><a href='#' onclick='hapusPengeluaran(\"{$data['id_pengeluaran']}\")'><img src='svg/trash.svg' alt=''></a></td>
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
