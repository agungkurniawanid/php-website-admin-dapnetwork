<?php
require 'connectionapi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ID = $_GET['id'];
    $KONEKSI = $connection_database;
    if ($KONEKSI) {
        $NAMA_AWAL = $_POST['namaawal'];
        $NAMA_AKHIR = $_POST['namaakhir'];
        $NIK = $_POST['nik'];
        $NOMOR_TELEPON = $_POST['nomor'];
        $EMAIL = $_POST['email'];
        $ALAMAT = $_POST['alamat'];
        $FOTO_PEGAWAI = null;
        
        // Ganti ini sesuai dengan path penyimpanan gambar di server
        $path_storage = '../images/';

        // Cek apakah ada foto yang diupload
        if (isset($_POST['foto_pegawai'])) {
            $img_base64 = $_POST['foto_pegawai'];
            $img_data = base64_decode($img_base64);
            $img_name = $NAMA_AWAL . '-' . time() . '.jpg'; // Sesuaikan dengan format dan nama file yang diinginkan
            $img_path = $path_storage . $img_name;

            // Simpan file gambar di server
            file_put_contents($img_path, $img_data);

            // Set path gambar untuk disimpan di database
            $FOTO_PEGAWAI = $img_path;
        }

        // Lakukan update data di database sesuai kebutuhan
        $SQL = "UPDATE tb_pegawai SET nama_awal = '$NAMA_AWAL', nama_akhir = '$NAMA_AKHIR', nik = '$NIK', alamat = '$ALAMAT', nomor_telepon = '$NOMOR_TELEPON', email = '$EMAIL'";
        
        // Tambahkan kondisi untuk update foto_pegawai jika $FOTO_PEGAWAI tidak null
        if ($FOTO_PEGAWAI !== null) {
            $SQL .= ", foto_pegawai = '$FOTO_PEGAWAI'";
        }

        $SQL .= " WHERE id_pegawai = '$ID'";
        
        $SQL_EXECUTE = mysqli_query($KONEKSI, $SQL);

        if ($SQL_EXECUTE) {
            echo json_encode(['status' => 'success', 'message' => 'Data updated successfully.'], JSON_PRETTY_PRINT);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to execute SQL query.'], JSON_PRETTY_PRINT);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database connection error.'], JSON_PRETTY_PRINT);
    }
}
?>
