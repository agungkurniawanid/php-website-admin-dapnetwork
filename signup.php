<?php require 'function/register.php' ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Agung Kurniawan" />
    <meta name="description" content="Sign up register" />
    <meta name="keywords" content="register" />
    <meta name="robots" content="index, follow" />
    <meta name="googlebot" content="index, follow" />
    <meta name="google" content="nositelinkssearchbox" />
    <meta name="google" content="notranslate" />
    <meta name="google" content="notranslate" />
    <link rel="stylesheet" href="css/all.css" />
    <link rel="stylesheet" href="css/signup.css" />
    <link rel="icon" type="image/x-icon" href="ico/dapnetwork.ico"> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Sign Up - DapnetWork</title>
  </head>
  <?php
  if (isset($_POST['submit'])) {
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
    } else if (empty(trim($_POST['notel']))) {
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
    } else if (strlen($_POST['notel']) < 11 || strlen($_POST['notel']) > 13) {
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
      if (register($_POST) > 0) {
        echo "
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: 'Registrasi berhasil!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              }).then(function() {
                window.location = 'signin.php';
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
                text: 'Registrasi gagal!',
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
    <div class="container">
      <div class="sub-container">
        <div class="logo">
          <div>
            <img src="https://i.ibb.co/zZkyGXj/Component-1.png" alt="logo" />
          </div>
          <div>Dapnetwork</div>
        </div>
        <div class="judul">Sign Up</div>
        <div class="deskripsi">
          Sign Up yang digunakan untuk membuat akun pegawai.
        </div>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="wrapper-input">
            <div class="input">
              <div><label for="namaawal">nama awal</label></div>
              <div>
                <input
                  type="text"
                  placeholder="Masukkan nama awal"
                  name="namaawal"
                  id="namaawal"
                  oninput="capitalized(this)"
                />
              </div>
            </div>
            <div class="input">
              <div><label for="namaakhir">nama akhir</label></div>
              <div>
                <input
                  type="text"
                  placeholder="Masukkan nama akhir"
                  name="namaakhir"
                  id="namaakhir"
                  oninput="capitalized(this)"
                />
              </div>
            </div>
            <div class="input">
              <div><label for="nik">Nomor NIK</label></div>
              <div>
                <input
                  type="text"
                  placeholder="Masukkan NIK"
                  name="nik"
                  id="nik"
                />
              </div>
            </div>
            <div class="input">
              <div><label for="jeniskelamin">jenis kelamin</label></div>
              <select name="jeniskelamin" id="jeniskelamin">
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
            <div class="input">
              <div><label for="username">Buat username</label></div>
              <div>
                <input
                  type="text"
                  placeholder="Masukkan username"
                  name="username"
                  id="username"
                />
              </div>
            </div>
            <div class="input">
              <div><label for="password">Buat password</label></div>
              <div>
                <input
                  type="password"
                  placeholder="Masukkan password"
                  name="password"
                  id="password"
                />
              </div>
            </div>
            <div class="input">
              <div><label for="nomor">Nomor telfon</label></div>
              <div>
                <input
                  type="number"
                  placeholder="Masukkan nomor telfon"
                  name="notel"
                  id="nomor"
                />
              </div>
            </div>
            <div class="input">
              <div><label for="email">Masukkan email</label></div>
              <div>
                <input
                  type="email"
                  placeholder="Masukkan email"
                  name="email"
                  id="email"
                />
              </div>
            </div>
            <div class="input">
              <div><label for="agama">Masukkan agama</label></div>
              <select name="agama" id="agama">
                <option value="Islam">Islam</option>
                <option value="Nasrani">Nasrani</option>
                <option value="Hindu">Hindu</option>
              </select>
            </div>
            <div class="input">
              <div><label for="lahir">Tanggal Lahir</label></div>
              <div>
                <input
                  type="date"
                  placeholder="Masukkan tgl lahir"
                  name="tanggallahir"
                  id="lahir"
                />
              </div>
            </div>
            <div class="input alamat">
              <div><label for="alamat">Alamat Lengkap</label></div>
              <div>
                <input
                  type="text"
                  placeholder="Alamat lengkap"
                  name="alamat"
                  id="alamat"
                  oninput="capitalized(this)"
                  require
                />
              </div>
            </div>
          </div>
          <div class="wrapper-input-image">
            <div class="image">
              <div>
                <label for="image"
                  ><img
                    src="https://i.ibb.co/W6wjBwY/Online-Review-pana-1.png"
                    alt="Placeholder-image-2"
                    border="0"
                    id="uploaded-image"
                /></label>
              </div>
              <div class="inputfile">
                <input
                  type="file"
                  name="foto"
                  id="image"
                  onchange="changeImage(this)"
                />
                <label for="image">Pilih foto</label>
              </div>
            </div>
          </div>
          <div class="wrapper-submit">
            <button type="submit" name="submit">Sign Up</button>
          </div>
        </form>
      </div>
    </div>
    <script src="js/signup.js"></script>
  </body>
</html>
