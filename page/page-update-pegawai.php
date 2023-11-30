<?php
require '../function/connection.php';
$SELECT_DATA_PEGAWAI_UPDATE = mysqli_query($connection_database, "SELECT * FROM tb_pegawai WHERE id_pegawai = '$_GET[id_pegawai]'");
$pegawai = mysqli_fetch_assoc($SELECT_DATA_PEGAWAI_UPDATE);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../ico/dapnetwork.ico" />
    <link rel="stylesheet" href="../css/page-update-pegawai.css" />
    <link rel="stylesheet" href="../css/all.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Update Pegawai</title>
</head>

<?php
require '../function/update-pegawai.php';
if (isset($_POST['submit'])) {
    if (updatePegawai($_POST) > 0) {
        echo "
              <script>
                document.addEventListener('DOMContentLoaded', function () {
                  Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Data pegawai berhasil diubah!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                  }).then((swipe)=>{
                      window.location.href = '../dsb-halaman-pegawai.php';
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
                    text: 'Data pegawai gagal diubah!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                  });
                });
              </script>";
    }
}
?>

<body>
    <div class="container-page-update-pegawai">
        <div class="wrapper-form">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_pegawai" value="<?= $pegawai['id_pegawai'] ?>">
                <input type="hidden" name="foto_lama" value="<?= $pegawai['foto_pegawai'] ?>">
                <p>Update Data Pegawai</p>
                <div class="input">
                    <div><label for="foto" class="labelfoto"><img src="../images/<?= $pegawai['foto_pegawai'] ?>" alt="" id="imageFormUpdatePegawai"></label></div>
                    <div><input type="file" name="foto" id="foto" onchange="changeImageFormUpdatePegawai(this)"></div>
                </div>
                <div class="input">
                    <div><label for="namaawal">Nama awal</label></div>
                    <div><input type="text" name="namaawal" id="namaawal" placeholder="Masukkan nama" value="<?= $pegawai['nama_awal'] ?>"></div>
                </div>
                <div class="input">
                    <div><label for="namaakhir">Nama akhir</label></div>
                    <div><input type="text" name="namaakhir" id="namaakhir" placeholder="Masukkan nama" value="<?= $pegawai['nama_akhir'] ?>"></div>
                </div>
                <div class="input">
                    <div><label for="nik">NIK</label></div>
                    <div><input type="text" name="nik" id="nik" placeholder="Masukkan NIK" value="<?= $pegawai['nik'] ?>"></div>
                </div>
                <div class="input">
                    <div><label for="jeniskelamin">Jenis Kelamin</label></div>
                    <div>
                        <select name="jeniskelamin" id="jeniskelamin">
                            <option value="Laki-Laki" <?php if ($pegawai['jenis_kelamin'] === 'Laki-Laki') echo 'selected'; ?>>Laki-Laki</option>
                            <option value="Perempuan" <?php if ($pegawai['jenis_kelamin'] === 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="input">
                    <div><label for="tgllahir">Tanggal lahir</label></div>
                    <div><input type="date" name="tanggallahir" id="tgllahir" value="<?= $pegawai['tanggal_lahir'] ?>"></div>
                </div>
                <div class="input">
                    <div><label for="alamat">Alamat</label></div>
                    <div><textarea name="alamat" id="alamat" cols="30" rows="5" placeholder="Masukkan alamat"><?= $pegawai['alamat'] ?></textarea></div>
                </div>
                <div class="input">
                    <div><label for="nomor">Nomor Telfon</label></div>
                    <div><input type="number" name="nomor" id="nomor" placeholder="Masukkan nomor" value="<?= $pegawai['nomor_telepon'] ?>"></div>
                </div>
                <div class="input">
                    <div><label for="email">Email</label></div>
                    <div><input type="email" name="email" id="email" placeholder="Masukkan email" value="<?= $pegawai['email'] ?>"></div>
                </div>
                <div class="input">
                    <div><label for="jabatan">Jabatan</label></div>
                    <div>
                        <select name="jabatan" id="jabatan">
                            <option value="Admin Server" <?php if ($pegawai['jabatan'] === 'Admin Server') echo 'selected'; ?>>Admin Server</option>
                            <option value="Teknisi" <?php if ($pegawai['jabatan'] === 'Teknisi') echo 'selected'; ?>>Teknisi</option>
                        </select>
                    </div>
                </div>
                <div class="input">
                    <div><label for="gaji">Gaji</label></div>
                    <div><input type="number" name="gaji" id="gaji" placeholder="Masukkan gaji" value="<?= $pegawai['gaji'] ?>"></div>
                </div>
                <div class="input">
                    <div><label for="username">Username</label></div>
                    <div><input type="text" name="username" id="username" placeholder="Masukkan username" value="<?= $pegawai['username'] ?>"></div>
                </div>
                <div class="input">
                    <div><label for="password">Password</label></div>
                    <div><input type="text" name="password" id="password" placeholder="Masukkan password" value="<?= $pegawai['password'] ?>"></div>
                </div>
                <div class="input">
                    <div><label for="status">Status</label></div>
                    <div>
                        <select name="status" id="status">
                            <option value="Aktif" <?php if ($pegawai['status'] === 'Aktif') echo 'selected'; ?>>Aktif</option>
                            <option value="Tidak aktif" <?php if ($pegawai['status'] === 'Tidak aktif') echo 'selected'; ?>>Tidak aktif</option>
                        </select>
                    </div>
                </div>
                <div class="input">
                    <div><label for="akses">Hak akses</label></div>
                    <div>
                        <select name="akses" id="akses">
                            <option value="Admin" <?php if ($pegawai['hak_akses_pegawai'] === 'Admin') echo 'selected'; ?>>Admin</option>
                            <option value="Teknisi" <?php if ($pegawai['hak_akses_pegawai'] === 'Teknisi') echo 'selected'; ?>>Teknisi</option>
                        </select>
                    </div>
                </div>
                <div class="input">
                    <div><label for="agama">agama</label></div>
                    <div>
                        <select name="agama" id="agama">
                            <option value="Islam" <?php if ($pegawai['agama'] === 'Islam') echo 'selected'; ?>>Islam</option>
                            <option value="Nasrani" <?php if ($pegawai['agama'] === 'Nasrani') echo 'selected'; ?>>Nasrani</option>
                            <option value="Hindu" <?php if ($pegawai['agama'] === 'Hindu') echo 'selected'; ?>>Hindu</option>
                        </select>
                    </div>
                </div>
                <div class="button">
                    <div><button type="submit" name="submit">Simpan</button></div>
                    <div><button type="button" onclick="window.location.href='../dsb-halaman-pegawai.php'">Kembali</button></div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function changeImageFormUpdatePegawai(input) {
            const fileInput = input.files[0];
            if (fileInput) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const imageElement = document.getElementById("imageFormUpdatePegawai");
                    imageElement.src = e.target.result;
                };

                reader.readAsDataURL(fileInput);
            }
        }
    </script>
</body>

</html>