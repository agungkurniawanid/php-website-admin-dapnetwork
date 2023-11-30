<?php 
require 'connectionapi.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $KONEKSI = $connection_database;
    $FILTER_LOKASI = $_GET['lokasi'];

    if ($KONEKSI) {
        $RESPONSE = array();
        $SQL = "SELECT * FROM tb_client JOIN tb_pembayaran ON tb_pembayaran.id_client = tb_client.id_client JOIN
        tb_pemesanan ON tb_pemesanan.id_client = tb_client.id_client JOIN 
        tb_paket_layanan ON tb_pemesanan.id_paket_layanan = tb_paket_layanan.id_paket_layanan
        WHERE tb_pembayaran.status_pembayaran = 'Belum Lunas' AND MONTH(tb_pembayaran.tanggal_pembayaran) = MONTH(CURRENT_DATE()) - 1";

        // Jika nilai lokasi tidak kosong, tambahkan ke kondisi WHERE
        if (!empty($FILTER_LOKASI) && $FILTER_LOKASI !== 'Semua') {
            $SQL .= " AND tb_client.alamat LIKE '%$FILTER_LOKASI%'";
        }

        $EXEC = mysqli_query($KONEKSI, $SQL);

        if ($EXEC) {
            while ($ROW = mysqli_fetch_assoc($EXEC)) {
                $DATA = [
                    'id_client' => $ROW['id_client'],
                    'nama_client' => $ROW['nama_client'],
                    'foto_client' => $ROW['foto_client'],
                    'harga_pemesanan' => $ROW['harga'],
                    'nomor_telepon' => $ROW['nomor_telepon'],
                ];
                $RESPONSE[] = $DATA;
            }

            echo json_encode(array('data' => $RESPONSE));
        }
    }
} else {
    $RESPONSE = array();
    $RESPONSE['code'] = 400;
    $RESPONSE['message'] = 'Method Not Allowed';
    echo json_encode($RESPONSE);
}
?>
