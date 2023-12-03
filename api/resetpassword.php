<?php
require 'connectionapi.php';

// Set header untuk memberitahu bahwa respons yang dihasilkan adalah JSON
header('Content-Type: application/json');

$response = array(); // Array untuk menyimpan respons

if (!empty($_POST['telfon'])) {
    $telfon = $_POST['telfon'];

    $con = $connection_database;
    if ($con) {
        try {
            $OOTP = rand(100000, 999999);
        } catch (Exception $e) {
        }
        $SQL_TBPEGAWAI = "SELECT * FROM tb_pegawai WHERE nomor_telepon = '$telfon'";
        $PROSES_TB_PEGAWAI = mysqli_query($con, $SQL_TBPEGAWAI);
        $FETCH_TB_PEGAWAI = mysqli_fetch_assoc($PROSES_TB_PEGAWAI);


        if (mysqli_num_rows($PROSES_TB_PEGAWAI) == 0) {
            $response['status'] = 'error';
            $response['message'] = 'User not found';
            echo json_encode($response);
            exit();
        }

        $ID_PEGAWAI = $FETCH_TB_PEGAWAI['id_pegawai'];
        $NAMA_PEGAWAI = $FETCH_TB_PEGAWAI['nama_awal'] . ' ' . $FETCH_TB_PEGAWAI['nama_akhir'];

        $SQL_TBRESET = "INSERT INTO tb_reset_password (id_pegawai, ootp) VALUES ('$ID_PEGAWAI', '$OOTP')";
        $PROSES_TB_RESET = mysqli_query($con, $SQL_TBRESET);

        if ($PROSES_TB_RESET) {

            if (mysqli_affected_rows($con) > 0) {
                // Send SMS via Fonnte API
                $token = 'mzZ5v_rmG9TKTf1d-FIs';
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.fonnte.com/send',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                        'target' => $telfon,
                        'message' => "RESET PASSWORD DAPNETWORK APP: \nHai $NAMA_PEGAWAI,\nKami ingin memberitahu Anda bahwa permintaan reset password Anda telah kami terima. Kode OTP Anda untuk mereset password adalah $OOTP. Silakan gunakan kode ini dalam aplikasi untuk mengatur ulang kata sandi Anda.\nJangan ragu untuk menghubungi tim dukungan kami jika Anda mengalami kesulitan atau memiliki pertanyaan lebih lanjut. Kami selalu siap membantu Anda.\nTerima kasih atas kepercayaan Anda pada DAPNETWORK APP!\nSalam hangat,\nTim Developer DAPNETWORK"
                    ),
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: ' . $token,
                    ),
                ));

                $response_sms = curl_exec($curl);

                curl_close($curl);

                if ($response_sms) {
                    $response['status'] = 'success';
                    $response['message'] = 'SMS sent successfully';
                    echo json_encode($response);
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Failed to send SMS';
                    echo json_encode($response);
                }
            }
        }
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Phone number parameter is missing';
    echo json_encode($response);
}
