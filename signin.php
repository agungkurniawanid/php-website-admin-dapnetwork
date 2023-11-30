<?php session_start() ?>
<?php include 'function/login.php' ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Agung Kurniawan" />
    <meta name="description" content="Log in " />
    <meta name="keywords" content="Log in" />
    <meta name="robots" content="index, follow" />
    <meta name="googlebot" content="index, follow" />
    <meta name="google" content="nositelinkssearchbox" />
    <meta name="google" content="notranslate" />
    <meta name="google" content="notranslate" />
    <link rel="stylesheet" href="css/all.css" />
    <link rel="stylesheet" href="css/signin.css" />
    <link rel="icon" type="image/x-icon" href="ico/dapnetwork.ico"> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Sign in - Dapnetwork</title>
  </head>
  <?php 
    if (isset($_POST['submit'])) {
      if (empty(trim($_POST['username'])) && empty(trim($_POST['password']))) {
        echo "
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Username dan password tidak boleh kosong!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              });
            });
          </script>";
      } else if (empty(trim($_POST['username']))){
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
      } else {
        $row = Login($_POST);
        if($row) {
          echo "
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                icon: 'success',
                title: 'Holaa!',
                text: 'Login berhasil!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              }).then(function() {
                window.location = 'dsb-halaman-utama.php';
              })
            });
          </script>";
        } else {
          echo "
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Username atau password salah!',
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
          <img src="https://i.ibb.co/zZkyGXj/Component-1.png" alt="logo" />
        </div>
        <div class="heading"><p>Selamat datang kembali</p></div>
        <div class="login-component">
          <div class="wrapper-input">
            <form action="" method="post">
              <div class="input">
                <!-- <div><label for="username">Username</label></div> -->
                <div>
                  <input
                    type="text"
                    placeholder="Masukkan username anda"
                    id="username"
                    name="username"
                  />
                </div>
              </div>
              <div class="input">
                <!-- <div><label for="password">Password</label></div> -->
                <div>
                  <input
                    type="password"
                    placeholder="Masukkan password anda"
                    id="password"
                    name="password"
                  />
                  <img src="svg/eye-off-line.svg" alt="icon-mata" id="clickPassword"/>
                </div>
              </div>
              <div class="lupa-password"><a href="#"></a></div>
              <div class="button">
                <button name="submit" type="submit">Sign in</button>
              </div>
              <input type="hidden" value="Admin" name="akses">
            </form>
          </div>
          <div class="nothaveaccount">
            Belum punya akun? <a href="signup.php">Sign up</a>
          </div>
        </div>
      </div>
    </div>
    <script src="js/signin.js"></script>
  </body>
</html>
