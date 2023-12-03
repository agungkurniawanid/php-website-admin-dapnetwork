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

    // Mendapatkan tanggal hari ini
    $current_date = date('Y-m-d');

    // Query untuk menghitung jumlah pemesanan pada tanggal instalasi yang dipilih
    $query_cek_pemesanan = "SELECT COUNT(*) as jumlah_pemesanan FROM tb_pemesanan WHERE DATE(tanggal_instalasi) = ?";
    $stmt_cek_pemesanan = mysqli_prepare($connection_database, $query_cek_pemesanan);
    mysqli_stmt_bind_param($stmt_cek_pemesanan, "s", $tanggalinstalasi);
    mysqli_stmt_execute($stmt_cek_pemesanan);
    $result_cek_pemesanan = mysqli_stmt_get_result($stmt_cek_pemesanan);
    $row_cek_jumlah_data_pemesanan = mysqli_fetch_assoc($result_cek_pemesanan);

    // Cek apakah tanggal instalasi valid
    if ($tanggalinstalasi == $current_date || $tanggalinstalasi < $current_date) {
        echo "<script>
        alert('Tanggal instalasi tidak valid. Silahkan pilih tanggal 1 hari ke depan atau lebih!');
        window.history.back();
        </script>";
        exit;
    }

    // Cek apakah pemesanan pada tanggal instalasi sudah penuh
    if ($row_cek_jumlah_data_pemesanan['jumlah_pemesanan'] >= 7) {
        echo "<script>
        alert('Maaf, pemesanan pada tanggal instalasi tersebut sudah penuh. Silahkan pilih tanggal lain!');
        window.history.back();
        </script>";
        exit;
    }

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
