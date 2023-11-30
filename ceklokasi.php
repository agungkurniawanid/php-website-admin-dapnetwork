<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css" />
    <link rel="stylesheet" href="dist/output.css" />
    <link rel="icon" type="image/x-icon" href="ico/dapnetwork.ico"/>
    <title>Lokasi Konfirmasi</title>
</head>

<body class="bg-gray-1">
    <div class="container w-full min-h-h-100vh flex justify-center items-center p-2">
        <div class="subcontainer p-4 bg-white rounded-3xl" style="width: 500px;">
            <h1 class="text-center text-2xl mb-4 font-poppins-800">Pilih Desa Tempat Anda</h1>
            <p class="p-2 mb-4 bg-red-trans-1 font-poppins-500 rounded-md text-normal font-poppins">Catatan: kami hanya dapat melayani instalasi pada lokasi desa pilihan dibawah ini, jika desa anda tidak anda kami mohon maaf tidak dapat melayani anda &#x1F622;</p>
            <select class="mb-4 w-full text-medium font-poppins" name="lokasi" id="lokasi">
                <option value="Pilih">Pilih Desa</option>
                <option value="Rogojampi">Rogojampi</option>
                <option value="Kedaleman">Kedaleman</option>
                <option value="Puspan">Puspan</option>
                <option value="Cawang">Cawang</option>
                <option value="Kepatihan">Kepatihan</option>
                <option value="Lemahbang">Lemahbang</option>
                <option value="Lincing">Lincing</option>
            </select>
            <div class="mb-4 btn grid grid-cols-2 gap-gap-10px mt-4">
                <button onclick="window.location.href='index.php'" class="hover:bg-blue-2 w-full hover:text-white p-2 bg-white shadow-box-shadow-1 font-poppins-500 text-normal rounded-md">kembali</button>
                <button onclick="konfirm()" class="hover:bg-blue-800 w-full p-2 bg-blue-2 text-white font-poppins-500 text-normal rounded-md">Konfirmasi</button>
            </div>
            <p id="notice" class="text-center text-medium font-poppins-500 text-red-600"></p>
        </div>
    </div>
    <script>
        function konfirm() {
            var lokasi = document.getElementById('lokasi').value;
            var notice = document.getElementById('notice');
            if (lokasi === 'Pilih') {
                notice.innerHTML = 'Pilih desa terlebih dahulu';
            } else {
                notice.innerHTML = '';
                // window.location.href = 'registrasi.php';
                window.location.href = 'registrasi.php?lokasi=' + lokasi;
            }
        }
    </script>
</body>

</html>