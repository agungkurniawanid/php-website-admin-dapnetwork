<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<?php
require './function/insert-pegawai.php';
if(isset($_POST['submit'])){
    if (empty(trim($_POST['namaawal']))) {
        echo "
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Nama awal tidak boleh kosong!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              });
            });
          </script>";
      } else if (strlen($_POST['namaawal']) < 3 || strlen($_POST['namaawal']) > 20) {
        echo "
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Nama awal minimal 3 karakter dan maksimal 20 karakter!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              });
            });
          </script>";
      } else if (empty(trim($_POST['namaakhir']))) {
        echo "
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Nama akhir tidak boleh kosong!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              });
            });
          </script>";
      } else if (strlen($_POST['namaakhir']) < 3 || strlen($_POST['namaakhir']) > 20) {
        echo "
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Nama akhir minimal 3 karakter dan maksimal 20 karakter!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              });
            });
          </script>";
      } else if (empty(trim($_POST['nik']))) {
        echo "
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'NIK tidak boleh kosong!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              });
            });
          </script>";
      } else if (!is_numeric($_POST['nik'])) {
        echo "
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'NIK harus berupa angka!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              });
            });
          </script>";
      } else if (strlen($_POST['nik']) < 16 || strlen($_POST['nik']) > 16) {
        echo "
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'NIK harus berjumlah 16 karakter!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              });
            });
          </script>";
      } else if (empty(trim($_POST['username']))) {
        echo "
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Username tidak boleh kosong!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              });
            });
          </script>";
      } else if (strlen($_POST['username']) < 3 || strlen($_POST['username']) > 20) {
        echo "
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Username minimal 3 karakter dan maksimal 20 karakter!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              });
            });
          </script>";
      } else if (empty(trim($_POST['password']))) {
        echo "
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Password tidak boleh kosong!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              });
            });
          </script>";
      } else if (strlen($_POST['password']) < 8 || strlen($_POST['password']) > 20) {
        echo "
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Password minimal 8 karakter dan maksimal 20 karakter!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              });
            });
          </script>";
      } else if (empty(trim($_POST['nomor']))) {
        echo "
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Nomor telfon tidak boleh kosong!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              });
            });
          </script>";
      } else if (strlen($_POST['nomor']) < 11 || strlen($_POST['nomor']) > 13) {
        echo "
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Nomor telfon minimal 11 karakter dan maksimal 13 karakter!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              });
            });
          </script>";
      } else if (empty(trim($_POST['email']))) {
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
      } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo "
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Email tidak valid!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              });
            });
          </script>";
      } else if (empty(trim($_POST['alamat']))) {
        echo "
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Alamat lengkap tidak boleh kosong!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              });
            });
          </script>";
      } else {
          if(insertPegawai($_POST) > 0){
            echo "
              <script>
                document.addEventListener('DOMContentLoaded', function () {
                  Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Data pegawai berhasil ditambahkan!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                  });
                });
              </script>";
          } else {
            echo "
              <script>
                document.addEventListener('DOMContentLoaded', function () {
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Data pegawai gagal ditambahkan!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                  });
                });
              </script>";
          }
      }
} 
?>

<body>
    <div class="wrapper-popup-insert-pegawai">
        <div class="header">
            <div>Tambah Pegawai</div>
            <div class="iconclose"><img src="svg/circle-xmark.svg" alt="close" id="btn-close-form-pegawai"></div>
        </div>
        <div class="body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="input">
                    <div><label for="foto" class="labelfoto"><img src="https://i.ibb.co/LhQ6Fr0/Upload-file-area.png" alt="" id="imageFormPegawai"></label></div>
                    <div><input type="file" name="foto" id="foto" onchange="changeImageFormPegawai(this)"></div>
                </div>
                <div class="input">
                    <div><label for="namaawal">Nama Awal</label></div>
                    <div><input type="text" name="namaawal" id="namaawal" placeholder="Masukkan nama"></div>
                </div>
                <div class="input">
                    <div><label for="namaakhir">Nama Akhir</label></div>
                    <div><input type="text" name="namaakhir" id="namaakhir" placeholder="Masukkan nama"></div>
                </div>
                <div class="input">
                    <div><label for="nik">NIK</label></div>
                    <div><input type="text" name="nik" id="nik" placeholder="Masukkan NIK"></div>
                </div>
                <div class="input">
                    <div><label for="jeniskelamin">Jenis Kelamin</label></div>
                    <div>
                        <select name="jeniskelamin" id="jeniskelamin">
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="input">
                    <div><label for="tgllahir">Tanggal lahir</label></div>
                    <div><input type="date" name="tanggallahir" id="tgllahir"></div>
                </div>
                <div class="input">
                    <div><label for="alamat">Alamat</label></div>
                    <div><textarea name="alamat" id="alamat" cols="30" rows="5" placeholder="Masukkan alamat"></textarea></div>
                </div>
                <div class="input">
                    <div><label for="nomor">Nomor Telfon</label></div>
                    <div><input type="number" name="nomor" id="nomor" placeholder="Masukkan nomor"></div>
                </div>
                <div class="input">
                    <div><label for="email">Email</label></div>
                    <div><input type="email" name="email" id="email" placeholder="Masukkan email"></div>
                </div>
                <div class="input">
                    <div><label for="jabatan">Jabatan</label></div>
                    <div>
                        <select name="jabatan" id="jabatan">
                            <option value="Admin Server">Admin Server</option>
                            <option value="Teknisi">Teknisi</option>
                        </select>
                    </div>
                </div>
                <div class="input">
                    <div><label for="gaji">Gaji</label></div>
                    <div><input type="number" name="gaji" id="gaji" placeholder="Masukkan gaji"></div>
                </div>
                <div class="input">
                    <div><label for="username">Username</label></div>
                    <div><input type="text" name="username" id="username" placeholder="Masukkan username"></div>
                </div>
                <div class="input">
                    <div><label for="password">Password</label></div>
                    <div><input type="text" name="password" id="password" placeholder="Masukkan password"></div>
                </div>
                <div class="input">
                    <div><label for="akses">Hak akses</label></div>
                    <div>
                        <select name="akses" id="akses">
                            <option value="Admin">Admin</option>
                            <option value="Teknisi">Teknisi</option>
                        </select>
                    </div>
                </div>
                <div class="input">
                    <div><label for="agama">agama</label></div>
                    <div>
                        <select name="agama" id="agama">
                            <option value="Islam">Islam</option>
                            <option value="Nasrani">Nasrani</option>
                            <option value="Hindu">Hindu</option>
                        </select>
                    </div>
                </div>
                <div class="button">
                    <button type="submit" name="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>