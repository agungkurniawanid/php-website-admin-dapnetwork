<?php
require '../function/connection.php';
function updatePembayaran($data) {
    global $connection_database;
    $ID = $data['id'];
    $HARGA_PAKET = $data['hargapaket'];
    $TANGGAL_BULAN = $data['tanggal'];
    $TOTAL_PEMBAYARAN = $data['totalpembayaran'];
    $METODE_BAYAR = $data['metodebayar'];
    $NOMINAL_BAYAR = $data['nominalbayar'];
    $KURANG_BAYAR = $data['kurangbayar'];
    $KEMBALIAN_BAYAR = $data['kembalianbayar'];
    $STATUS = $data['status'];

    // cek apakah ada bukti diunggah 
    if(!empty($_FILES['bukti']['name'])) {
        $bukti_lama = htmlspecialchars($data["buktilama"]);
        $folder_tujuan = "../images/";
        $nama_file = $_FILES['bukti']['name'];
        $lokasi_simpan = $folder_tujuan . $nama_file;

        // pindahkan bukti yang diunggah
        move_uploaded_file($_FILES['bukti']['tmp_name'], $lokasi_simpan);
        $bukti = $nama_file;
    } else {
        $bukti = htmlspecialchars($data["buktilama"]);
    }
    $SQL = "UPDATE tb_catatan_pembayaran SET
    tanggal_pembayaran = '$TANGGAL_BULAN', total_pembayaran = '$TOTAL_PEMBAYARAN',
    metode_pembayaran = '$METODE_BAYAR', nominal_pembayaran = '$NOMINAL_BAYAR',
    kurang_pembayaran = '$KURANG_BAYAR', kembalian_pembayaran = '$KEMBALIAN_BAYAR',
    bukti_pembayaran = '$bukti', status_pembayaran = '$STATUS' WHERE id_catatan_pembayaran = '$ID'";
    mysqli_query($connection_database, $SQL);
    return mysqli_affected_rows($connection_database); 
}
?>