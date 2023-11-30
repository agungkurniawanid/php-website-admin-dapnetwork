<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/all.css" />
    <style>
        .form-container {
            max-width: 400px;
            width: 400px;
            background-color: #fff;
            max-height: 500px;
            overflow-y: auto;
            padding: 32px 24px;
            font-size: 14px;
            position: fixed;
            transform: translate(-50%, -50%);
            top: 0%;
            left: 50%;
            z-index: 100;
            transition: all .3s ease-in-out;
            opacity: 0;
            visibility: hidden;
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

<body>
    <div class="form-container">
        <div class="close">
            <img id="closeButton" src="../svg/cross-small.svg" alt="">
        </div>

        <div class="logo-container">
            Tambah Pembayaran
        </div>

        <form class="form" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_pembayaran" value="<?= $SELECT_TB_PEMBAYARAN_ROW['id_pembayaran'] ?>">
            <input type="hidden" name="id_client" value="<?= $_GET['id_client'] ?>">
            <input type="hidden" name="id_pemesanan" value="<?= $SELECT_TB_PEMESANAN_ROW['id_pemesanan'] ?>">
            <input type="hidden" name="id_paket_layanan" value="<?= $SELECT_TB_PEMESANAN_ROW['id_paket_layanan'] ?>">
            <div class="form-group">
                <input type="hidden" id="hargadipesan" value="<?= $SELECT_TB_PEMESANAN_ROW['harga'] ?>">
                <div>
                    <label for="nominal">Nominal Pembayaran</label>
                    <input type="number" id="nominal" name="nominal_pembayaran" placeholder="Masukkan Nominal Pembayaran">
                </div>
                <div style="margin-top: 1rem;">
                    <label for="kurang">Kurang Pembayaran</label>
                    <input type="number" id="kurang" name="kurang_pembayaran" placeholder="Kurang Pembayaran" readonly>
                </div>
                <div style="margin-top: 1rem;">
                    <label for="kembalian">Kembalian Pembayaran</label>
                    <input type="number" id="kembalian" name="kembalian_pembayaran" placeholder="Kembalian Pembayaran" readonly>
                </div>
                <div style="margin-top: 1rem;">
                    <label for="total">Total Pembayaran</label>
                    <input type="number" id="total" name="total_pembayaran" placeholder="Total Pembayaran" readonly>
                </div>
                <div style="margin-top: 1rem;">
                    <label for="status">Status Pembayaran</label>
                    <input type="text" id="status" name="status_pembayaran" placeholder="Status Pembayaran" readonly>
                </div>
                <div style="margin-top: 1rem;">
                    <label for="metode">Metode Pembayaran</label>
                    <select name="metode_pembayaran" id="metode">
                        <option value="Cash">Cash</option>
                        <option value="Transfer">Transfer</option>
                    </select>
                </div>
                <div style="margin-top: 1rem;">
                    <label for="total">Kurang Pembayaran</label>
                    <input type="file" name="foto">
                </div>
            </div>
            <button class="form-submit-btn" type="submit" name="pembayaran">Kirim Pembayaran</button>
        </form>
    </div>
    <script>
        // Mendapatkan elemen HTML
        const nominalInput = document.getElementById('nominal');
        const kurangInput = document.getElementById('kurang');
        const totalInput = document.getElementById('total');
        const kembalianInput = document.getElementById('kembalian');
        const statusInput = document.getElementById('status');
        const hargadipesanInput = document.getElementById('hargadipesan');

        // Menambahkan event listener untuk setiap perubahan pada input nominal
        nominalInput.addEventListener('input', function() {
            // Menghitung kurang, total, dan kembalian
            const nominal = parseFloat(nominalInput.value);
            const hargadipesan = parseFloat(hargadipesanInput.value);

            // Menetapkan nilai total berdasarkan kondisi
            const total = nominal >= hargadipesan ? hargadipesan : nominal;

            const kurang = hargadipesan - total;
            const kembalian = nominal - hargadipesan;

            // Menetapkan nilai pada input yang sesuai
            kurangInput.value = kurang >= 0 ? kurang : 0;
            totalInput.value = total;
            kembalianInput.value = kembalian >= 0 ? kembalian : 0;

            // Menetapkan status berdasarkan kondisi
            statusInput.value = kurang === 0 ? 'Lunas' : 'Belum Lunas';
        });
    </script>
</body>

</html>