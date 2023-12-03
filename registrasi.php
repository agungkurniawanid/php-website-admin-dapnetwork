<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/all.css" />
  <link rel="stylesheet" href="dist/output.css" />
  <link rel="icon" type="image/x-icon" href="ico/dapnetwork.ico" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>Registrasi</title>
</head>

<?php
require 'function/registrasi.php';

if (!isset($_GET['lokasi'])) {
  header("Location: ceklokasi.php");
  exit;
}

if (isset($_POST['submit'])) {
  if (!isset($_POST['namalengkap'])) {
    echo "
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Nama lengkap tidak boleh kosong!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              });
            });
          </script>";
  } else if (!isset($_POST['nomor'])) {
    echo "
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Nomor tidak boleh kosong!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              });
            });
          </script>";
  } else if (strlen($_POST['nomor']) > 13 || strlen($_POST['nomor']) < 11) {
    echo "
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Nomor harus berjumlah 11, 12 atau 13!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              });
            });
          </script>";
  } else if (!isset($_POST['alamat'])) {
    echo "
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Alamat tidak boleh kosong',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              });
            });
          </script>";
  } else if (!isset($_POST['email'])) {
    echo "
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Email tidak boleh kosong!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              });
            });
          </script>";
  } else {
    if (InsertClient($_POST) > 0) {
      echo "
          <script>
              document.addEventListener('DOMContentLoaded', function () {
                  Swal.fire({
                      icon: 'success',
                      title: 'Success',
                      text: 'Berhasil Daftar',
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'OK'
                  }).then((swipe) => {
                      window.location.href = 'pemesanan.php?namalengkap=" . $_POST['namalengkap'] . "';
                  });
              });
          </script>";
    }
  }
}

$lokasi = isset($_GET['lokasi']) ? $_GET['lokasi'] : '';
$alamatText = '';

if ($lokasi == 'Cawang') {
  $alamatText = "Dusun Cawang, Desa Benelan Kidul Kecamatan Singojuruh, (Masukkan RT) (Masukkan RW)";
} else if ($lokasi == 'Puspan') {
  $alamatText = "Dusun Puspan, Desa Rogojampi Kecamatan Rogojampi, (Masukkan RT) (Masukkan RW)";
} else if ($lokasi == 'Rogojampi') {
  $alamatText = "Desa Rogojampi Kecamatan Rogojampi, (Masukkan RT) (Masukkan RW)";
} else if ($lokasi == 'Kedaleman') {
  $alamatText = "Dusun Kedaleman, Desa Rogojampi, Kecamatan Rogojampi, (Masukkan RT) (Masukkan RW)";
} else if ($lokasi == 'Kepatihan') {
  $alamatText = "Dusun Kepatihan, Desa Rogojampi, Kecamatan Rogojampi, (Masukkan RT) (Masukkan RW)";
} else if ($lokasi == 'Lemahbang') {
  $alamatText = "Dusun Lemahbang, Desa Rogojampi, Kecamatan Rogojampi, (Masukkan RT) (Masukkan RW)";
} else if ($lokasi == 'Lincing') {
  $alamatText = "Dusun Lincing, Desa Rogojampi, Kecamatan Rogojampi, (Masukkan RT) (Masukkan RW)";
}
?>

<body class="bg-gray-2">
  <div class="CONTAINER w-full h-h-otomatis flex justify-center p-8">
    <div class="SUB-CONTAINER w-auto h-h-otomatis">
      <div class="mb-8"><img onclick="window.location.href='index.php'" class="w-10 scale-x-mirror-1 cursor-pointer bg-blue-2 rounded-full" src="ico/angle-small-right (1) 1.svg" alt=""></div>
      <div class="WRAPPER-CARD bg-white p-8 rounded-3xl w-full shadow-box-shadow-1">
        <div class="flex justify-center"><img class="w-28" src="https://i.imgur.com/Cz52lRv.png" alt=""></div>
        <div class="HEADER w-full flex justify-center">
          <p class="text-3xl font-poppins-800 capitalize">Registrasi Pemesanan</p>
        </div>
        <div class="BODY mt-6 w-auto">
          <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="lokasi" value="<?= $_GET['lokasi'] ?>">
            <div class="input w-full">
              <div><label class="text-medium font-poppins-500" for="foto">Foto Anda (Opsional)</label></div>
              <div>
                <input class="opacity-0 invisible" onchange="changeImageForm(this)" type="file" name="foto" id="foto">
                <label for="foto"><img id="image-client-form" class="cursor-pointer w-full max-w-w-500px max-h-h-500 object-cover" src="https://i.imgur.com/kxbLXm3.png" alt=""></label>
              </div>
            </div>
            <div class="input w-full mt-4">
              <div><label for="nama" class="text-medium font-poppins-500">Nama lengkap</label></div>
              <div><input class="text-normal border-none w-full checked:outline-none p-3 bg-gray-1 rounded-md" type="text" placeholder="Masukkan Nama" name="namalengkap"></div>
            </div>
            <div class="input w-full mt-4">
              <div><label for="jeniskelamin" class="text-medium font-poppins-500">Jenis Kelamin</label></div>
              <div>
                <select name="jeniskelamin" id="jeniskelamin" class="text-normal w-full p-4 bg-gray-1 rounded-md">
                  <option value="Laki-Laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>
            </div>
            <div class="input w-full mt-4">
              <div><label for="alamat" class="text-medium font-poppins-500">Alamat Lengkap</label></div>
              <div><textarea class="text-normal border-none w-full checked:outline-none p-3 bg-gray-1 rounded-md" name="alamat" id="alamat" cols="30" rows="5" placeholder="Masukkan Alamat Lengkap"><?= $alamatText ?></textarea>
              </div>
            </div>
            <div class="input w-full mt-4">
              <div><label for="nomor" class="text-medium font-poppins-500">Nomor Telfon</label></div>
              <div><input class="text-normal border-none w-full checked:outline-none p-3 bg-gray-1 rounded-md" type="number" name="nomor" id="nomor" placeholder="Masukkan Nomor Telfon"></div>
            </div>
            <div class="input w-full mt-4">
              <div><label class="text-medium font-poppins-500" for="email">Email Address</label></div>
              <div><input class="text-normal border-none w-full checked:outline-none p-3 bg-gray-1 rounded-md" type="email" name="email" id="email" placeholder="Masukkan Email"></div>
            </div>
            <div class="btn w-full mt-8">
              <button class="w-full bg-blue-2 text-white p-4 rounded-md font-poppins-500 hover:bg-blue-800" type="submit" name="submit">Daftar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    const changeImageForm = (input) => {
      const fileInput = input.files[0];
      if (fileInput) {
        const reader = new FileReader();

        reader.onload = function(e) {
          const imageElement = document.getElementById("image-client-form");
          imageElement.src = e.target.result;
        };

        reader.readAsDataURL(fileInput);
      }
    }
  </script>
</body>

</html>