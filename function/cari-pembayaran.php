<?php
require 'connection.php';

if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];

    $query = "SELECT * FROM tb_client 
    JOIN tb_catatan_pembayaran ON tb_client.id_client = tb_catatan_pembayaran.id_client
    WHERE 
        (tb_client.nama_client LIKE '%$keyword%' OR
        tb_catatan_pembayaran.tanggal_pembayaran LIKE '%$keyword%') AND 
        tb_catatan_pembayaran.metode_pembayaran = 'Cash'
    ORDER BY tb_catatan_pembayaran.tanggal_pembayaran DESC";
    
    $result = mysqli_query($connection_database, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($data = mysqli_fetch_assoc($result)) {
                echo "<div class='cookie-card'>
                <span class='title'>{$data['nama_client']}</span>
                <p class='description'>{$data['alamat']}</p>
                <div class='actions'>
                    <button class='pref'>
                        {$data['tanggal_pembayaran']}
                    </button>
                    <button class='accept'>
                        Detail Client
                    </button>
                </div>
            </div>";
            }
        } else {
            echo "<div class='cookie-card'>
                    <span class='title'>Tidak Ada Data</span>
                </div>";
        }
    } else {
        echo "Error: " . mysqli_error($connection_database);
    }
}
?>
