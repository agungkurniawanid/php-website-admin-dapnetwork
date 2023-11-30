<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css" />
    <link rel="icon" type="image/x-icon" href="ico/dapnetwork.ico" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Bayar Online</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100vh;
        }

        .form {
            background-color: #fff;
            display: block;
            padding: 1rem;
            max-width: 350px;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .form-title {
            font-size: 1.25rem;
            line-height: 1.75rem;
            font-weight: 600;
            text-align: center;
            color: #000;
        }

        .input-container {
            position: relative;
        }

        .input-container input,
        .form button {
            outline: none;
            border: 1px solid #e5e7eb;
            margin: 8px 0;
        }

        .input-container input {
            background-color: #fff;
            padding: 1rem;
            padding-right: 3rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
            width: 300px;
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .input-container span {
            display: grid;
            position: absolute;
            top: 0;
            bottom: 0;
            right: 0;
            padding-left: 1rem;
            padding-right: 1rem;
            place-content: center;
        }

        .input-container span svg {
            color: #9CA3AF;
            width: 1rem;
            height: 1rem;
        }

        .submit {
            display: block;
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
            padding-left: 1.25rem;
            padding-right: 1.25rem;
            background-color: #4F46E5;
            color: #ffffff;
            cursor: pointer;
            font-size: 0.875rem;
            line-height: 1.25rem;
            font-weight: 500;
            width: 100%;
            border-radius: 0.5rem;
            text-transform: uppercase;
        }

        .signup-link {
            color: #6B7280;
            font-size: 0.875rem;
            line-height: 1.25rem;
            text-align: center;
        }

        .signup-link a {
            text-decoration: underline;
        }

        img {
            width: 40px;
            object-fit: cover;
            padding: 10px;
            border-radius: 50%;
        }

        img:hover {
            background-color: #f4f4f4;
            cursor: pointer;
        }

        .btn-kembali {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }
    </style>
</head>

<?php
require 'function/cekemailnomor.php';

if(isset($_POST['submit'])) {
    $result = cekNomorTelepon($_POST);
    if($result == "nomor_terverifikasi") {
        // gunakan sweet alert
        echo "
        <script>
                document.addEventListener('DOMContentLoaded', function () {
                  Swal.fire({
                    title: 'Nomor Terverifikasi!',
                    text: 'Lanjutkan untuk pembayaran tagihan bulanan anda terimakasih!',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oke',
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location = 'detail-pembayaran.php?pembayaran=" . $_POST['nomor-email'] . "';
                    }
                  })
                });
              </script>";
    } else if($result == "tidak_terverifikasi") {
        echo "
        <script>
                document.addEventListener('DOMContentLoaded', function () {
                  Swal.fire({
                    title: 'Nomor Tidak Terverifikasi!',
                    text: 'Nomor yang di masukkan harus terdaftar saat instalasi dulu.',
                    icon: 'error',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oke',
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location = 'bayar-online.php';
                    }
                  })
                });
              </script>";
    }
}
?>


<body>
    <div class="container">
        <div class="btn-kembali">
            <img src="svg/angle-left 1.svg" alt="" onclick="history.back()">
            <p>Kembali</p>
        </div>
        <form class="form" action="" method="post">
            <p class="form-title">Pembayaran Online</p>
            <div class="input-container">
                <input placeholder="Masukkan Nomor Telepon" type="text" name="nomor-email">
            </div>
            <button class="submit" type="submit" name="submit">
                Sign in
            </button>
            <p class="signup-link">
                Email dan Nomor yang di masukkan harus terdaftar saat instalasi dulu.
            </p>
        </form>
    </div>
</body>

</html>