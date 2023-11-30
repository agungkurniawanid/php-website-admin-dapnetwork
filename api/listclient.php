<?php
require "connectionapi.php";

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $KONEKSI = $connection_database;

    if($KONEKSI) {
        $SQL = "SELECT nama_awal, nama_akhir, jabatan, foto_pegawai FROM tb_pegawai";
        $SQL_PROCESS = mysqli_query($KONEKSI, $SQL);

        $RESPONSE = array();
        while($ROW = mysqli_fetch_assoc($SQL_PROCESS)) {
            $DATA = array(
                'namaawal' => $ROW['nama_awal'],
                'namaakhir' => $ROW['nama_akhir'],
                'jabatan' => $ROW['jabatan'],
                'fotopegawai' => $ROW['foto_pegawai']
            );
            $RESPONSE[] = $DATA;
        }

        echo json_encode(array('data' => $RESPONSE));
    }
} 
?>  