<?php

require 'connectionapi.php';

if (!empty($_POST['ootp'])) {
    $ootp = $_POST['ootp'];
    $con = $connection_database;

    if ($con) {
        $SQL_TBRESET = "SELECT * FROM tb_reset_password WHERE ootp = ?";
        $stmt = mysqli_prepare($con, $SQL_TBRESET);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $ootp);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                echo json_encode(array("status" => "success", "ootp" => $ootp));
            } else {
                echo json_encode(array("status" => "failed", "message" => "Kode OTP tidak valid."));
            }
            mysqli_stmt_close($stmt);
        } else {
            echo json_encode(array("status" => "failed", "message" => "Gagal menyiapkan statement."));
        }
    } else {
        echo json_encode(array("status" => "failed", "message" => "Gagal terhubung ke database."));
    }
} else {
    echo json_encode(array("status" => "failed", "message" => "Parameter ootp tidak boleh kosong."));
}
?>
