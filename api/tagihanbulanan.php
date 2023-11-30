<?php
require 'connectionapi.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $KONEKSI = $connection_database;
    $ID_CLIENT = $_GET['id_client'];
    if ($KONEKSI) {
        $SQL = "SELECT 
                    tb_pemesanan.id_pemesanan,
                    tb_paket_layanan.id_paket_layanan,
                    tb_paket_layanan.jenis_paket_layanan,
                    tb_paket_layanan.harga,
                    tb_catatan_pembayaran.status_pembayaran,
                    tb_catatan_pembayaran.id_pembayaran,
                    tb_catatan_pembayaran.kurang_pembayaran
                FROM 
                    tb_pemesanan
                JOIN 
                    tb_paket_layanan ON tb_pemesanan.id_paket_layanan = tb_paket_layanan.id_paket_layanan
                JOIN 
                    tb_catatan_pembayaran ON tb_catatan_pembayaran.id_pemesanan = tb_pemesanan.id_pemesanan
                WHERE 
                    tb_pemesanan.id_client = '$ID_CLIENT'
                    AND MONTH(tb_catatan_pembayaran.tanggal_pembayaran) = MONTH(CURRENT_DATE()) - 1";

        $EXEC = mysqli_query($KONEKSI, $SQL);
        $RESPONSE = [];
        $TOTAL_PEMBAYARAN = 0;

        while ($ROW = mysqli_fetch_assoc($EXEC)) {
            // Pengecekan sebelum mengakses elemen array
            $harga = isset($ROW['harga']) ? $ROW['harga'] : 0;
            $kurang_pembayaran = isset($ROW['kurang_pembayaran']) ? $ROW['kurang_pembayaran'] : 0;

            if ($ROW['status_pembayaran'] == 'Bayar Double') {
                // Jika status pembayaran Bayar Double
                $TOTAL_PEMBAYARAN += $harga * 2;
            } elseif ($ROW['status_pembayaran'] == 'Belum Lunas' && $kurang_pembayaran > 0) {
                // Jika status pembayaran Belum Lunas dan ada kurang bayar
                $TOTAL_PEMBAYARAN += ($harga + $kurang_pembayaran);
            } elseif ($ROW['status_pembayaran'] == 'Belum Lunas') {
                // Jika status pembayaran Belum Lunas tanpa kurang bayar
                $TOTAL_PEMBAYARAN += $harga;
            } else if ($ROW['status_pembayaran'] == 'Bayar Double' && $kurang_pembayaran > 0) {
                $TOTAL_PEMBAYARAN += ($harga * 2 + $kurang_pembayaran);
            } else {
                // Jika tidak memenuhi kondisi di atas, normal tampilkan harga paket layanan
                $TOTAL_PEMBAYARAN += $harga;
            }

            $RESPONSE = [
                'total_pembayaran' => $TOTAL_PEMBAYARAN,
                'id_pembayaran' => $ROW['id_pembayaran'],
                'id_pemesanan' => $ROW['id_pemesanan'],
                'id_paket_layanan' => $ROW['id_paket_layanan'],
            ];
            
        }
        echo json_encode(['data' => $RESPONSE]);
    }
}
