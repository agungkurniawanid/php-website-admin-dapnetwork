<?php
require 'connection.php';

function pemesanan($data)
{
    global $connection_database;

    $id_pemesanan = $data['idpemesanan'];
    $id_client = $data['idclient'];
    $tanggalpesan = date('Y-m-d');
    $nama_bank = htmlspecialchars(trim($data['bank']));
    $rekening = htmlspecialchars(trim($data['rekening']));
    $tanggalinstalasi = htmlspecialchars(trim($data['tanggalinstalasi']));
    $statuspemesanan = 'Belum selesai';
    $catatan = htmlspecialchars(trim($data['catatan']));
    $paket = htmlspecialchars(trim($data['paket']));


    // todo mengecek jumlah pemesanan datang 
    // Mendapatkan tanggal hari ini
    $current_date = date('Y-m-d');

    // Mendapatkan tanggal 1 hari ke depan
    $satu_hari_kedepan = date('Y-m-d', strtotime($current_date . ' + 1 day'));

    // Mendapatkan tanggal 2 hari ke depan
    $dua_hari_kedepan = date('Y-m-d', strtotime($current_date . ' + 2 days'));

    // Mendapatkan tanggal 3 hari ke depan
    $tiga_hari_kedepan = date('Y-m-d', strtotime($current_date . ' + 3 days'));

    // Query untuk menghitung jumlah pemesanan pada 1 hari kedepan
    $query_cek_1hari_kedepan = "SELECT COUNT(*) as jumlah_pemesanan_1hari_kedepan FROM tb_pemesanan WHERE DATE(tanggal_instalasi) = ?";
    $stmt_cek_1hari_kedepan = mysqli_prepare($connection_database, $query_cek_1hari_kedepan);
    mysqli_stmt_bind_param($stmt_cek_1hari_kedepan, "s", $satu_hari_kedepan);
    mysqli_stmt_execute($stmt_cek_1hari_kedepan);
    $result_cek_1hari_kedepan = mysqli_stmt_get_result($stmt_cek_1hari_kedepan);
    $row_cek_jumlah_data_1hari_kedepan = mysqli_fetch_assoc($result_cek_1hari_kedepan);

    // Query untuk menghitung jumlah pemesanan pada 2 hari kedepan
    $query_cek_2hari_kedepan = "SELECT COUNT(*) as jumlah_pemesanan_2hari_kedepan FROM tb_pemesanan WHERE DATE(tanggal_instalasi) = ?";
    $stmt_cek_2hari_kedepan = mysqli_prepare($connection_database, $query_cek_2hari_kedepan);
    mysqli_stmt_bind_param($stmt_cek_2hari_kedepan, "s", $dua_hari_kedepan);
    mysqli_stmt_execute($stmt_cek_2hari_kedepan);
    $result_cek_2hari_kedepan = mysqli_stmt_get_result($stmt_cek_2hari_kedepan);
    $row_cek_jumlah_data_2hari_kedepan = mysqli_fetch_assoc($result_cek_2hari_kedepan);

    // Query untuk menghitung jumlah pemesanan pada 3 hari kedepan
    $query_cek_3hari_kedepan = "SELECT COUNT(*) as jumlah_pemesanan_3hari_kedepan FROM tb_pemesanan WHERE DATE(tanggal_instalasi) = ?";
    $stmt_cek_3hari_kedepan = mysqli_prepare($connection_database, $query_cek_3hari_kedepan);
    mysqli_stmt_bind_param($stmt_cek_3hari_kedepan, "s", $tiga_hari_kedepan);
    mysqli_stmt_execute($stmt_cek_3hari_kedepan);
    $result_cek_3hari_kedepan = mysqli_stmt_get_result($stmt_cek_3hari_kedepan);
    $row_cek_jumlah_data_3hari_kedepan = mysqli_fetch_assoc($result_cek_3hari_kedepan);

    // Cek apakah ada pemesanan pada 1 hari kedepan
    if ($row_cek_jumlah_data_1hari_kedepan['jumlah_pemesanan_1hari_kedepan'] >= 10) {
        echo "<script>
        alert('Maaf Pemesanan 1 hari kedepan sudah penuh');
        window.history.back();
        </script>";
        exit;
    } else if ($row_cek_jumlah_data_2hari_kedepan['jumlah_pemesanan_2hari_kedepan'] >= 10) {
        echo "<script>
        alert('Maaf Pemesanan 2 hari kedepan sudah penuh');
        window.history.back();
        </script>";
        exit;
    } else if ($row_cek_jumlah_data_3hari_kedepan['jumlah_pemesanan_3hari_kedepan'] >= 10) {
        echo "<script>
        alert('Maaf Pemesanan 3 hari kedepan sudah penuh');
        window.history.back();
        </script>";
        exit;
    } else if ($tanggalinstalasi == $current_date) {
        echo "<script>
        alert('Anda tidak bisa memesan instalasi hari ini! silahkan pesan 1 hari kedepan - 3 hari atau lebih kedepan!');
        window.history.back();
        </script>";
        exit;
    } else if ($tanggalinstalasi <= $current_date) {
        echo "<script>
        alert('Anda tidak bisa memesan instalasi hari yang lalu, silahkan pesan 1 hari kedepan - 3 hari atau lebih kedepan!');
        window.history.back();
        </script>";
        exit;
    } else {
        // Query untuk memasukkan data ke database
        $query = "INSERT INTO tb_pemesanan VALUES (
        '$id_pemesanan', '$id_client', '$tanggalpesan','$nama_bank', '$rekening', 
        '$tanggalinstalasi', '$statuspemesanan', '$catatan', '$paket'
    )";
        $pemesanan = mysqli_query($connection_database, $query);
        if ($pemesanan) {
            return mysqli_affected_rows($connection_database);
        } else {
            echo "<script>alert('Error saat memasukkan data ke database!')</script>";
        }
    }
}
