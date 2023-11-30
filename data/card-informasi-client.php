<?php 

// todo toal client penagiha
$SQL_PENAGIHAN = "SELECT COUNT(*) AS total_client FROM tb_client JOIN tb_pembayaran ON tb_client.id_client = tb_pembayaran.id_client WHERE tb_pembayaran.status_pembayaran = 'Belum Lunas' AND MONTH(tb_pembayaran.tanggal_pembayaran) = MONTH(CURRENT_DATE())";
$QUERY_PENAGIHAN = mysqli_query($connection_database, $SQL_PENAGIHAN);
$ROW_PENAGIHAN = mysqli_fetch_assoc($QUERY_PENAGIHAN);

// todo total client belum bayar
$SQL_BELUM_BAYAR = "SELECT COUNT(*) AS total_belum_bayar FROM tb_client JOIN tb_pembayaran ON tb_client.id_client = tb_pembayaran.id_client WHERE tb_pembayaran.status_pembayaran = 'Belum Lunas' AND MONTH(tb_pembayaran.tanggal_pembayaran) = MONTH(CURRENT_DATE())";
$QUERY_BELUM_BAYAR = mysqli_query($connection_database, $SQL_BELUM_BAYAR);
$ROW_BELUM_BAYAR = mysqli_fetch_assoc($QUERY_BELUM_BAYAR);

// todo total client sudah bayar
$SQL_SUDAH_BAYAR = "SELECT COUNT(*) AS total_sudah_bayar FROM tb_client 
               JOIN tb_pembayaran ON tb_pembayaran.id_client = tb_client.id_client 
               WHERE tb_pembayaran.status_pembayaran = 'Lunas' 
               AND MONTH(tb_pembayaran.tanggal_pembayaran) = MONTH(CURRENT_DATE())";
$QUERY_SUDAH_BAYAR = mysqli_query($connection_database, $SQL_SUDAH_BAYAR);
$ROW_SUDAH_BAYAR = mysqli_fetch_assoc($QUERY_SUDAH_BAYAR);

// todo total client bayar double
$SQL_BAYAR_DOUBLE = "SELECT COUNT(*) AS total_bayar_double FROM tb_client JOIN tb_pembayaran ON tb_client.id_client = tb_pembayaran.id_client WHERE tb_pembayaran.status_pembayaran = 'Bayar Double' AND MONTH(tb_pembayaran.tanggal_pembayaran) = MONTH(CURRENT_DATE())";
$QUERY_BAYAR_DOUBLE = mysqli_query($connection_database, $SQL_BAYAR_DOUBLE);
$ROW_BAYAR_DOUBLE = mysqli_fetch_assoc($QUERY_BAYAR_DOUBLE);

// todo total client kurang bayar
$SQL_KURANG_BAYAR = "SELECT COUNT(*) AS total_kurang_bayar FROM tb_client JOIN tb_pembayaran ON tb_client.id_client = tb_pembayaran.id_client WHERE tb_pembayaran.status_pembayaran = 'Kurang Bayar' AND MONTH(tb_pembayaran.tanggal_pembayaran) = MONTH(CURRENT_DATE())";
$QUERY_KURANG_BAYAR = mysqli_query($connection_database, $SQL_KURANG_BAYAR);
$ROW_KURANG_BAYAR = mysqli_fetch_assoc($QUERY_KURANG_BAYAR);

// todo total instalasi belum selesai
$SQL_BELUM_SELESAI = "SELECT COUNT(*) AS total_belum_selesai FROM tb_client JOIN tb_pemesanan ON tb_client.id_client = tb_pemesanan.id_client WHERE tb_pemesanan.status_pemesanan_instalasi = 'Belum selesai' AND MONTH(tb_pemesanan.tanggal_pesan_instalasi) = MONTH(CURRENT_DATE());";
$QUERY_BELUM_SELESAI = mysqli_query($connection_database, $SQL_BELUM_SELESAI);
$ROW_BELUM_SELESAI = mysqli_fetch_assoc($QUERY_BELUM_SELESAI);

// todo total client baru daftar 
$SQL_BARU_DAFTAR = "SELECT COUNT(*) AS total_baru_daftar FROM tb_client WHERE MONTH(tanggal_masuk) = MONTH(CURDATE())";
$QUERY_BARU_DAFTAR = mysqli_query($connection_database, $SQL_BARU_DAFTAR);
$ROW_BARU_DAFTAR = mysqli_fetch_assoc($QUERY_BARU_DAFTAR);

// todo total client aktif
$SQL_AKTIF = "SELECT COUNT(*) AS total_client_aktif FROM tb_client WHERE status_client = 'Aktif'";
$QUERY_AKTIF = mysqli_query($connection_database, $SQL_AKTIF);
$ROW_AKTIF = mysqli_fetch_assoc($QUERY_AKTIF);

// todo total client tidak aktif
$SQL_TIDAK_AKTIF = "SELECT COUNT(*) AS total_client_aktif FROM tb_client WHERE status_client = 'Tidak Aktif'";
$QUERY_TIDAK_AKTIF = mysqli_query($connection_database, $SQL_TIDAK_AKTIF);
$ROW_TIDAK_AKTIF = mysqli_fetch_assoc($QUERY_TIDAK_AKTIF);

$card_informasi_client = [
    [
        "title1" => "Penagihan",
        "title2" => date('F'),
        "backgoround-color" => "#F4F6FE",
        "color" => "#4B80EF",
        "link" => "page/page-cardinformasi-client.php",
        "total" => $ROW_PENAGIHAN['total_client']
    ],
    [
        "title1" => "Client",
        "title2" => "Belum bayar",
        "backgoround-color" => "#e8f6fd",
        "color" => "#09425d",
        "link" => "page/page-cardinformasi-client-belumbayar.php",
        "total" => $ROW_BELUM_BAYAR['total_belum_bayar']
    ],
    [
        "title1" => "Client",
        "title2" => "Sudah Lunas",
        "backgoround-color" => "#FAEAF4",
        "color" => "#5D093E",
        "link" => "page/page-cardinformasi-client-sudahbayar.php",
        "total" => $ROW_SUDAH_BAYAR['total_sudah_bayar']
    ],
    [
        "title1" => "Client",
        "title2" => "Bayar Double",
        "backgoround-color" => "#DCFCE7",
        "color" => "#3CD856",
        "link" => "page/page-cardinformasi-client-bayardobel.php",
        "total" => $ROW_BAYAR_DOUBLE['total_bayar_double']
    ],
    [
        "title1" => "Client",
        "title2" => "Kurang Bayar",
        "backgoround-color" => "#FFFAF1",
        "color" => "#FFBA4A",
        "link" => "page/page-cardinformasi-client-kurangbayar.php",
        "total" => $ROW_KURANG_BAYAR['total_kurang_bayar']
    ],
    [
        "title1" => "Client Instalasi",
        "title2" => "Belum Selesai",
        "backgoround-color" => "#F4F6FE",
        "color" => "#4B80EF",
        "link" => "page/page-cardinformasi-client-belumselesai.php",
        "total" => $ROW_BELUM_SELESAI['total_belum_selesai']
    ],
    [
        "title1" => "Client",
        "title2" => "Baru Daftar",
        "backgoround-color" => "#F3E8FF",
        "color" => "#BF83FF",
        "link" => "page/page-cardinformasi-client-barudaftar.php",
        "total" => $ROW_BARU_DAFTAR['total_baru_daftar']
    ],
    [
        "title1" => "Client",
        "title2" => "Status Aktif",
        "backgoround-color" => "#FFE2E5",
        "color" => "#FA5A7D",
        "link" => "page/page-cardinformasi-client-aktif.php",
        "total" => $ROW_AKTIF['total_client_aktif']
    ],
    [
        "title1" => "Client Status",
        "title2" => "Tidak Aktif",
        "backgoround-color" => "#F4F6FE",
        "color" => "#4B80EF",
        "link" => "page/page-cardinformasi-client-tidakaktif.php",
        "total" => $ROW_TIDAK_AKTIF['total_client_aktif']
    ],
]
?>