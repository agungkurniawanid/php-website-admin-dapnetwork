<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
require 'connectionapi.php';

// Set header untuk memberitahu bahwa respons yang dihasilkan adalah JSON
header('Content-Type: application/json');

$response = array(); // Array untuk menyimpan respons

if (!empty($_POST['email'])) {
    $email = $_POST['email'];
    $con = $connection_database;
    if ($con) {
        try {
            $OOTP = rand(100000, 999999);
        } catch (Exception $e) {
        }
        $SQL_TBPEGAWAI = "SELECT * FROM tb_pegawai WHERE email = '$email'";
        $PROSES_TB_PEGAWAI = mysqli_query($con, $SQL_TBPEGAWAI);
        $FETCH_TB_PEGAWAI = mysqli_fetch_assoc($PROSES_TB_PEGAWAI);
        if(mysqli_num_rows($PROSES_TB_PEGAWAI) == 0) {
            $response['status'] = 'error';
            $response['message'] = 'User not found';
            echo json_encode($response);
            exit();
        }
        $ID_PEGAWAI = $FETCH_TB_PEGAWAI['id_pegawai'];

        $SQL_TBRESET = "INSERT INTO tb_reset_password (id_pegawai, ootp) VALUES ('$ID_PEGAWAI', '$OOTP')";
        $PROSES_TB_RESET = mysqli_query($con, $SQL_TBRESET);
        if ($PROSES_TB_RESET) {
            if (mysqli_affected_rows($con) > 0) {
                $mail = new PHPMailer(true);
                try {
                    $mail = new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'agungklewang26@gmail.com';
                    $mail->Password = 'qjng okuu ouov vlhz';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;
                    $mail->SMTPDebug  = 2;
                    $mail->setFrom('adgt1378@gmail.com');
                    $mail->addAddress($email);
                    $mail->isHTML(true);
                    $mail->Subject = "RESET PASSWORD DAPNETWORK APP";
                    $mail->Body = '<p style="color: #000; font-size: 24px font-weight:bold;"> KODE OTP ANDA : ' . $OOTP . '</p>';
                    $mail->send();
                    
                    $response['status'] = 'success';
                    $response['message'] = 'Email sent successfully';
                    echo json_encode($response);
                } catch (Exception $e) {
                    $response['status'] = 'error';
                    $response['message'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    echo json_encode($response);
                }
            }
        }
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Email parameter is missing';
    echo json_encode($response);
}
?>
