<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css" />
    <link rel="stylesheet" href="dist/output.css" />
    <link rel="icon" type="image/x-icon" href="ico/dapnetwork.ico"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Nota</title>
    <!-- Tambahkan script html2pdf -->
    <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
</head>

<?php 
require 'function/connection.php';
if(!isset($_GET['idpemesanan'])) {
    header("Location: ceklokasi.php");
    exit;
}

$SELECT_STATUS_PEMBAYARAN = "SELECT * FROM tb_pembayaran 
    JOIN tb_pemesanan ON tb_pemesanan.id_pemesanan = tb_pembayaran.id_pemesanan 
    WHERE tb_pembayaran.id_pemesanan = ?";

$stmt = mysqli_prepare($connection_database, $SELECT_STATUS_PEMBAYARAN);
mysqli_stmt_bind_param($stmt, "s", $_GET['idpemesanan']);
mysqli_stmt_execute($stmt);
$RESULT_STATUS_PEMBAYARAN = mysqli_stmt_get_result($stmt);
$ROW_DATA = mysqli_fetch_assoc($RESULT_STATUS_PEMBAYARAN);

$TANGGAL_INGIN_INSTALASI = $_GET['tanggalinstalasi'];
$TANGGAL_INSTALASI = date("d F Y", strtotime($TANGGAL_INGIN_INSTALASI));
?>

<body class="bg-gray-2 flex justify-center">
    <div class="container w-full h-h-otomatis p-4 flex justify-center">
        <div class="subcontainer bg-white rounded-3xl p-4" style="width: 400px;">
            <div class="header w-full flex justify-end">
                <img onclick="window.location.href='index.php'" class="cursor-pointer w-5" src="ico/cross 1.svg" alt="close">
            </div>
            <div class="body">
                <div>
                    <h1 class="text-2xl font-poppins-800 text-center">Pemesanan & Pembayaran Selesai</h1>
                    <p class="rounded-md mt-4 p-2 bg-red-trans-1 font-poppins-500 text-normal">Simpan Nota atau ID Pemesanan anda, jika anda ingin untuk melakukan pembatalan. Pembatalan pemesanan dapat dilakukan sebelum tanggal instalasi yang anda tentukan.</p>
                </div>
                <div class="mt-4 flex flex-col gap-gap-10px justify-center" id="hokok">
                    <div class="idpemesanan shadow-box-shadow-1 p-4 rounded-md">
                        <div class="font-poppins-600">ID Pemesanan</div>
                        <div><?= $_GET['idpemesanan'] ?></div>
                    </div>
                    <div class="idpemesanan shadow-box-shadow-1 p-4 rounded-md">
                        <div class="font-poppins-600">Nama Anda</div>
                        <div><?= $_GET['namalengkap'] ?></div>
                    </div>
                    <div class="idpemesanan shadow-box-shadow-1 p-4 rounded-md">
                        <div class="font-poppins-600">Tanggal akan instalasi</div>
                        <div><?= $TANGGAL_INSTALASI ?></div>
                    </div>
                    <div class="idpemesanan shadow-box-shadow-1 p-4 rounded-md">
                        <div class="font-poppins-600">Status Pembayaran</div>
                        <div><?= $ROW_DATA['status_pembayaran'] ?></div>
                    </div>
                </div>
            </div>
            <button type="submit" name="submit" class="mt-4 w-full p-2 bg-blue-2 shadow-box-shadow-1 font-poppins-500 text-normal text-white rounded-md" onclick="generatePDF()">Download PDF</button>
        </div>
    </div>
    <?php 
    if(isset($_POST['submit'])) {
        echo 
        "<script>
        alert('download pdf dulu');
        </script>";
        exit;
    }
    ?>
    <script>
        function generatePDF() {
            // Mengambil elemen yang ingin dijadikan PDF
            const element = document.getElementById('hokok');

            // Konfigurasi opsi untuk html2pdf
            const options = {
                margin: 10,
                filename: 'nota.pdf',
                image: {
                    type: 'png',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                }
            };

            // Menghasilkan file PDF dari elemen
            html2pdf(element, options);
        }
    </script>
</body>

</html>