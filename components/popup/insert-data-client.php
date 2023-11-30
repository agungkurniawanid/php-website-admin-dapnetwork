
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <?php 
  require 'function/connection.php';
  require 'function/insert-client.php';
  if(isset($_POST['submit'])) {
    if(!isset($_POST['namalengkap'])) {
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
    }
    else if (!isset($_POST['alamat'])) {
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
    } else if (!isset($_POST['email'])){
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
      if(InsertClient($_POST) > 0) {
        echo "
        <script>
          document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
              icon: 'success',
              title: 'Bravo...',
              text: 'Client berhasil ditambah!',
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
    <div class="wrapper-popup-halaman-client">
      <div class="iconclose-judul">
        <div class="judul">Tambah data client</div>
        <div class="iconclose">
          <img
            src="svg/circle-xmark.svg"
            alt="icon close"
            id="closeButtonClient"
          />
        </div>
      </div>
      <div class="wrapper-input-form">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="input">
            <div><label for="namalengkap">Nama lengkap</label></div>
            <input
              type="text"
              name="namalengkap"
              placeholder="Masukkan nama lengkap"
            />
          </div>
          <div class="input">
            <div><label for="jeniskelamin">Jenis kelamin</label></div>
            <select name="jeniskelamin" id="jeniskelamin">
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>
          <div class="input">
            <div><label for="alamat">Alamat</label></div>
            <textarea name="alamat" id="alamat" cols="50" rows="5"></textarea>
          </div>
          <div class="input">
            <div><label for="nomor">Nomor</label></div>
            <input type="number" name="nomor" placeholder="Masukkan nomor" />
          </div>
          <div class="input">
            <div><label for="email">Email</label></div>
            <input type="email" name="email" placeholder="Masukkan email" />
          </div>
          <div class="input">
            <div><label for="foto">Foto</label></div>
            <input
              type="file"
              name="foto"
              id="foto"
              onchange="changeImageHalamanClient(this)"
            />
            <label for="foto" id="fotoinputhalamanclient">Pilih foto</label>
          </div>
          <div class="inputfoto-halamanclient">
            <img
              src="https://i.ibb.co/48WyDd6/Group-3.png"
              alt=""
              id="uploaded-image-halamanclient"
            />
          </div>
          <div class="submit-halaman-client">
            <button type="submit" name="submit">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
