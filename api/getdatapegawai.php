<?php
require 'connectionapi.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $ID = $_GET['id'];
    $KONEKSI = $connection_database;
    if ($KONEKSI) {
        $RESPONSE = [];
        $SQL = "SELECT * FROM tb_pegawai WHERE id_pegawai = '$ID'";
        $SQL_EXECUTE = mysqli_query($KONEKSI, $SQL);
        if ($SQL_EXECUTE) {
            while ($ROW = mysqli_fetch_assoc($SQL_EXECUTE)) {
                $DATA = [
                    'namaawal' => $ROW['nama_awal'],
                    'namaakhir' => $ROW['nama_akhir'],
                    'nik' => $ROW['nik'],
                    'jenis_kelamin' => $ROW['jenis_kelamin'],
                    'tanggal_lahir' => $ROW['tanggal_lahir'],
                    'alamat' => $ROW['alamat'],
                    'nomor_telepon' => $ROW['nomor_telepon'],
                    'email' => $ROW['email'],
                    'jabatan' => $ROW['jabatan'],
                    'gaji' => $ROW['gaji'],
                    'tanggal_masuk' => $ROW['tanggal_masuk'],
                    'foto_pegawai' => $ROW['foto_pegawai'],
                    'username' => $ROW['username'],
                    'password' => password_verify($ROW['password'], $ROW['password']),
                    'status' => $ROW['status'],
                    'hak_akses' => $ROW['hak_akses_pegawai'],
                    'agama' => $ROW['agama']
                ];
                $RESPONSE[] = $DATA;
            }
            echo json_encode(['status' => 'success', 'data' => $RESPONSE], JSON_PRETTY_PRINT);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to execute SQL query.'], JSON_PRETTY_PRINT);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database connection error.'], JSON_PRETTY_PRINT);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.'], JSON_PRETTY_PRINT);
}
?>
