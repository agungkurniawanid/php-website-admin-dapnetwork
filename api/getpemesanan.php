<?php
require "connectionapi.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $KONEKSI = $connection_database;

    if ($KONEKSI) {
        $FILTER_TANGGAL = isset($_GET['tanggal']) ? $_GET['tanggal'] : null;
        $RESPONSE = [];

        $SQL = "SELECT * FROM tb_client
                JOIN tb_catatan_pembayaran ON tb_client.id_client = tb_catatan_pembayaran.id_client
                JOIN tb_pemesanan ON tb_client.id_client = tb_pemesanan.id_client 
                JOIN tb_paket_layanan ON tb_paket_layanan.id_paket_layanan = tb_pemesanan.id_paket_layanan
                WHERE tb_pemesanan.status_pemesanan_instalasi = 'Belum selesai'";

        if (!is_null($FILTER_TANGGAL) && $FILTER_TANGGAL != 'Semua') {
            $SQL .= " AND DATE(tb_pemesanan.tanggal_instalasi) = '$FILTER_TANGGAL' AND YEAR(tb_pemesanan.tanggal_instalasi) = YEAR(CURDATE())";
        }

        $QUERY = mysqli_query($KONEKSI, $SQL);

        if ($QUERY) {
            while ($ROW = mysqli_fetch_assoc($QUERY)) {
                $DATA = [
                    'id_pembayaran' => $ROW['id_pembayaran'],
                    'id_pemesanan' => $ROW['id_pemesanan'],
                    'id_client' => $ROW['id_client'],
                    'id_paket_layanan' => $ROW['id_paket_layanan'],
                    'nama_client' => $ROW['nama_client'],
                    'tanggal_pesan_instalasi' => $ROW['tanggal_pesan_instalasi'],
                    'status_pemesanan_instalasi' => $ROW['status_pemesanan_instalasi'],
                    'tanggal_instalasi' => $ROW['tanggal_instalasi'],
                    'catatan' => $ROW['catatan'],
                    'jenis_paket_layanan' => $ROW['jenis_paket_layanan'],
                    'harga' => $ROW['harga'],
                    'status_pembayaran' => $ROW['status_pembayaran']
                ];
                $RESPONSE[] = $DATA;
            }
            echo json_encode(['data' => $RESPONSE]);
        } else {
            // Tampilkan pesan kesalahan query
            echo json_encode(['error' => mysqli_error($KONEKSI)]);
        }
    }
}
?>
