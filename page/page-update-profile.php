<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/all.css" />
    <link rel="stylesheet" href="../css/page-update-profile.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Page Update Profile</title>
</head>
<?php
require '../function/connection.php';
require '../function/update-profile.php';

$nama_awal = isset($_GET['nama_awal']) ? $_GET['nama_awal'] : '';
$QUERY = mysqli_query($connection_database, "SELECT * FROM tb_pegawai WHERE nama_awal = '$nama_awal'");
$row = mysqli_fetch_assoc($QUERY); 


if(isset($_POST['update'])) {
    if(UpdateProfile($_POST) > 0) {
        echo "
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'success',
                        title: 'Selamat...',
                        text: 'Data berhasil di update',
                        timer: 1000,
                        showConfirmButton: false,
                    }).then(function (result) {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            window.location.href='page-profile.php?user=$row[nama_awal]';
                        }
                    });
                });
            </script>
        ";
    }
}

?>
<body>
    <form class="form" action="" method="post">
        <!-- id dan foto lama -->
        <input type="hidden" name="id" value="<?= $row['id_pegawai'] ?>">
        <input type="hidden" name="fotolama" value="<?= $row['foto_pegawai'] ?>">

        <p class="title">Update Profile</p>
        <p class="message">Ganti data disini</p>
        <div class="flex">
            <label>
                <input required="" value="<?= $row['nama_awal'] ?>" name="namaawal" placeholder="" type="text" class="input">
                <span>Nama awal</span>
            </label>
            <label>
                <input required="" value="<?= $row['nama_akhir'] ?>" name="namaakhir" placeholder="" type="text" class="input">
                <span>Nama akhir</span>
            </label>
        </div>
        <label>
            <input required="" value="<?= $row['nik'] ?>" name="nik" placeholder="" type="text" class="input">
            <span>NIK</span>
        </label>
        <label>
            <select name="jeniskelamin" class="input" id="jeniskelamin">
                <option value="Laki-Laki" <?php if($row['jenis_kelamin'] == "Laki-Laki"){echo "selected";} ?>>Laki-Laki</option>
                <option value="Perempuan" <?php if($row['jenis_kelamin'] == "Perempuan"){echo "selected";} ?>>Perempuan</option>
            </select>
        </label>
        <label>
            <input required="" value="<?= $row['tanggal_lahir'] ?>" name="tanggallahir" placeholder="" type="date" class="input">
        </label>
        <label>
            <input required="" value="<?= $row['alamat'] ?>" name="alamat" placeholder="" type="text" class="input">
            <span>Alamat</span>
        </label>
        <label>
            <input required="" value="<?= $row['nomor_telepon'] ?>" name="nomortelfon" placeholder="" type="number" class="input">
            <span>Nomor telfon</span>
        </label>
        <label>
            <input required="" value="<?= $row['email'] ?>" name="email" placeholder="" type="email" class="input">
            <span>Email</span>
        </label>
        <label>
            <select name="jabatan" class="input" id="jabatan">
                <option value="Admin Server" <?php if($row['jabatan'] == "Admin Server"){echo "selected";} ?>>Admin Server</option>
                <option value="Teknisi" <?php if($row['jabatan'] == "Teknisi"){echo "selected";} ?>>Teknisi</option>
            </select>
        </label>
        <label>
            <input required="" value="<?= $row['gaji'] ?>" name="gaji" placeholder="" type="number" class="input">
            <span>Gaji</span>
        </label>
        <label>
            <input required="" value="<?= $row['tanggal_masuk'] ?>" name="tanggalmasuk" placeholder="" type="date" class="input">
        </label>
        <label>
            <input name="foto" placeholder="" type="file" class="input">
            <img src="../images/<?= $row['foto_pegawai'] ?>" alt="">
        </label>
        <label>
            <select name="status" class="input" id="status">
                <option value="Aktif" <?php if($row['status'] == "Aktif"){echo "selected";} ?>>Aktif</option>
                <option value="Tidak Aktif" <?php if($row['status'] == "Tidak Aktif"){echo "selected";} ?>>Tidak Aktif</option>
            </select>
        </label>
        <label>
            <select name="hakakses" class="input" id="hakakses">
                <option value="Admin" <?php if($row['hak_akses_pegawai'] == "Admin"){echo "selected";} ?>>Admin</option>
                <option value="Teknisi" <?php if($row['hak_akses_pegawai'] == "Teknisi"){echo "selected";} ?>>Teknisi</option>
            </select>
        </label>
        <label>
            <select name="agama" class="input" id="agama">
                <option value="Islam" <?php if($row['agama'] == "Islam"){echo "selected";} ?>>Islam</option>
                <option value="Kristen" <?php if($row['agama'] == "Kristen"){echo "selected";} ?>>Kristen</option>
                <option value="Katolik" <?php if($row['agama'] == "Katolik"){echo "selected";} ?>>Katolik</option>
                <option value="Hindu" <?php if($row['agama'] == "Hindu"){echo "selected";} ?>>Hindu</option>
                <option value="Budha" <?php if($row['agama'] == "Budha"){echo "selected";} ?>>Budha</option>
            </select>
        </label>
        <button type="submit" name="update" class="submit">Simpan</button>
    </form>
</body>

</html>