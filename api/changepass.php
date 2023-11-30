<?php
require 'connectionapi.php';

if (!empty($_POST['changepass']) && !empty($_POST['confirmpass'])) {
    $changepass = password_hash($_POST['changepass'], PASSWORD_DEFAULT);
    $confirmpass = password_hash($_POST['confirmpass'], PASSWORD_DEFAULT);
    $OOTP = $_POST['ootp'];
    $con = $connection_database;

    if ($_POST['changepass'] != $_POST['confirmpass']) {
        echo json_encode(array("status" => "failed", "message" => "Password tidak sama."));
    } else if (strlen($_POST['changepass']) < 8) {
        echo json_encode(array("status" => "failed", "message" => "Password kurang dari 8 karakter."));
    } else if (strlen($_POST['changepass']) > 20) {
        echo json_encode(array("status" => "failed", "message" => "Password lebih dari 20 karakter."));
    } else {
        if ($con) {
            $SQL = "UPDATE tb_pegawai 
                    JOIN tb_reset_password ON tb_pegawai.id_pegawai = tb_reset_password.id_pegawai 
                    SET tb_pegawai.password = '$confirmpass'
                    WHERE tb_reset_password.ootp = '$OOTP'";

            $PROSES = mysqli_query($con, $SQL);

            if ($PROSES) {
                echo json_encode(array("status" => "success", "message" => "Password berhasil diubah."));
            } else {
                echo json_encode(array("status" => "failed", "message" => "Password gagal diubah."));
            }
        } else {
            echo json_encode(array("status" => "failed", "message" => "Gagal terhubung ke database."));
        }
    }
} else if (!empty($_POST['changepass']) && empty($_POST['confirmpass'])) {
    echo json_encode(array("status" => "failed", "message" => "Konfirmasi password tidak boleh kosong."));
} else {
    echo json_encode(array("status" => "failed", "message" => "Parameter password tidak boleh kosong."));
}
