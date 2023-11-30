<?php
require 'connectionapi.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $ID = mysqli_real_escape_string($connection_database, $_GET['id']);

    $RESPONSE = [];
    $SQL = "SELECT * FROM tb_pegawai WHERE id_pegawai = ?";
    $stmt = mysqli_prepare($connection_database, $SQL);
    mysqli_stmt_bind_param($stmt, "s", $ID);
    mysqli_stmt_execute($stmt);
    $SQL_EXECUTE = mysqli_stmt_get_result($stmt);

    if ($SQL_EXECUTE) {
        if (mysqli_num_rows($SQL_EXECUTE) > 0) {
            $ROW = mysqli_fetch_assoc($SQL_EXECUTE);
            $DATA = [
                'namaawal' => $ROW['nama_awal'],
                'namaakhir' => $ROW['nama_akhir'],
                'nik' => $ROW['nik'],
                'nomor_telepon' => $ROW['nomor_telepon'],
                'email' => $ROW['email'],
                'alamat' => $ROW['alamat'],
                'foto_pegawai' => $ROW['foto_pegawai']
            ];
            $RESPONSE[] = $DATA;
            echo json_encode(['status' => 'success', 'data' => $RESPONSE], JSON_PRETTY_PRINT);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No data found.'], JSON_PRETTY_PRINT);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to execute SQL query.'], JSON_PRETTY_PRINT);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.'], JSON_PRETTY_PRINT);
}
?>
