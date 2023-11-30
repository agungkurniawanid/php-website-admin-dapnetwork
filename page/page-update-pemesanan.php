<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/all.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Update Pemesanan</title>
    <style>
        body {
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            max-width: 400px;
            width: 400px;
            background-color: #fff;
            padding: 32px 24px;
            font-size: 14px;
            z-index: 100;
            transition: all .3s ease-in-out;
            font-family: inherit;
            color: #212121;
            display: flex;
            flex-direction: column;
            gap: 20px;
            box-sizing: border-box;
            border-radius: 10px;
            box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.084), 0px 2px 3px rgba(0, 0, 0, 0.168);
        }

        .form-container button:active {
            scale: 0.95;
        }

        .form-container .logo-container {
            text-align: center;
            font-weight: 600;
            font-size: 18px;
        }

        .form-container .form {
            display: flex;
            flex-direction: column;
        }

        .form-container .form-group {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .form-container .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-container .form-group input {
            width: 100%;
            padding: 12px 16px;
            border-radius: 6px;
            font-family: inherit;
            border: 1px solid #ccc;
        }

        .form-container .form-group input::placeholder {
            opacity: 0.5;
        }

        .form-container .form-group input:focus {
            outline: none;
            border-color: #1778f2;
        }

        .form-container .form-submit-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: inherit;
            color: #fff;
            background-color: #212121;
            border: none;
            width: 100%;
            padding: 12px 16px;
            font-size: inherit;
            gap: 8px;
            margin: 12px 0;
            cursor: pointer;
            border-radius: 6px;
            box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.084), 0px 2px 3px rgba(0, 0, 0, 0.168);
        }

        .form-container .form-submit-btn:hover {
            background-color: #313131;
        }

        .form-container .link {
            color: #1778f2;
            text-decoration: none;
        }

        .form-container .signup-link {
            align-self: center;
            font-weight: 500;
        }

        .form-container .signup-link .link {
            font-weight: 400;
        }

        .form-container .link:hover {
            text-decoration: underline;
        }

        .close {
            width: 100%;
            display: flex;
            justify-content: flex-end;
        }

        .close img {
            width: 28px;
            cursor: pointer;
        }
    </style>
</head>

<?php
require '../function/connection.php';
require '../function/update-pemesanan.php';
$SQL = "SELECT * FROM tb_pemesanan JOIN tb_paket_layanan ON tb_pemesanan.id_paket_layanan = tb_paket_layanan.id_paket_layanan WHERE tb_pemesanan.id_pemesanan = '$_GET[pemesanan]'";
$QUERY = mysqli_query($connection_database, $SQL);
$DATA = mysqli_fetch_assoc($QUERY);

$SQL_PAKET = "SELECT * FROM tb_paket_layanan";
$QUERY_PAKET = mysqli_query($connection_database, $SQL_PAKET);
// todo untuk edit
if (isset($_POST['editpemesanan'])) {
    if (editPemesanan($_POST) > 0) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Data pemesanan berhasil diedit!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'page-detail-client.php?id_client=' + '$_GET[id_client]';
                });
            });
        </script>";
    }
}
?>

<body>
    <div class="form-container">
        <div class="logo-container">
            Tambah Pembayaran
        </div>
        <form class="form" action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="hidden" name="id_paket_layanan" value="<?= $DATA['id_paket_layanan'] ?>">
                <div>
                    <label for="bank">Nama Bank</label>
                    <select name="bank" id="bank">
                        <option value="BCA" <?php if ($DATA['nama_bank'] == 'BCA') echo 'selected'; ?>>BCA</option>
                        <option value="MANDIRI" <?php if ($DATA['nama_bank'] == 'MANDIRI') echo 'selected'; ?>>MANDIRI</option>
                        <option value="BRI" <?php if ($DATA['nama_bank'] == 'BRI') echo 'selected'; ?>>BRI</option>
                    </select>
                </div>
                <div style="margin-top: 1rem;">
                    <label for="rekening">Nomor Rekening</label>
                    <input type="text" name="rekening" value="<?= $DATA['nomor_rekening'] ?>">
                </div>
                <div style="margin-top: 1rem;">
                    <label for="status_instalasi">Status Instalasi</label>
                    <select name="status_instalasi" id="status_instalasi">
                        <option value="Selesai" <?php if ($DATA['status_pemesanan_instalasi'] == 'Selesai') echo 'selected'; ?>>Selesai</option>
                        <option value="Belum selesai" <?php if ($DATA['status_pemesanan_instalasi'] == 'Belum selesai') echo 'selected'; ?>>Belum selesai</option>
                    </select>
                </div>
                <div style="margin-top: 1rem;">
                    <label for="catatan">Catatan Client</label>
                    <input type="text" name="catatan" value="<?= $DATA['catatan'] ?>">
                </div>
                <div style="margin-top: 1rem;">
                    <label for="jenis_paket">Paket Dipesan</label>
                    <select name="jenis_paket" id="jenis_paket" onchange="updateInputValue()">
                        <?php foreach ($QUERY_PAKET as $value) : ?>
                            <option value="<?= $value['jenis_paket_layanan'] ?>" data-id="<?= $value['id_paket_layanan'] ?>" <?php if ($DATA['jenis_paket_layanan'] == $value['jenis_paket_layanan']) echo 'selected'; ?>>
                                <?= $value['jenis_paket_layanan'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <input type="hidden" name="id_paket" id="input_id_paket" readonly>
            </div>
            <button class="form-submit-btn" type="submit" name="editpemesanan">Kirim Pembayaran</button>
        </form>
    </div>
    <script>
        function updateInputValue() {
            var dropdown = document.getElementById("jenis_paket");
            var selectedOption = dropdown.options[dropdown.selectedIndex];
            var inputValue = selectedOption.getAttribute("data-id");

            // Mengupdate nilai input text
            document.getElementById("input_id_paket").value = inputValue;
        }
    </script>
</body>

</html>