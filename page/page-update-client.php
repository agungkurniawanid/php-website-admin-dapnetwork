<?php 
require '../function/update-client.php';
if (isset($_POST['update'])) {
    if (UpdateClient($_POST) > 0) {
        echo "
        <script>
        alert('data berhasil update');
        document.location.href='../dsb-halaman-client.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('data gagal update');
        document.location.href='./index.php';
        </script>
        ";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Update Client - Dasbor Klien | Dapnetwork">
    <link rel="icon" type="image/x-icon" href="ico/dapnetwork.ico" />
    <link rel="stylesheet" href="../css/all.css" />
    <link rel="stylesheet" href="../css/page-update-client.css" />
    <title>Update Client - Dasbor Klien | Dapnetwork</title>
</head>

<body>
    <div class="wrapper-update-client">
        <div class="wrapper-btnkembali">
            <img src="../svg/arrow-left.svg" alt="" onclick="window.location.href='../dsb-halaman-client.php'">
            Kembali
        </div>
        <div class="wrapper-input">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="input">
                    <div>
                        <label for="id_client">ID Client</label>
                    </div>
                    <input type="text" name="id_client" id="id_client" value="<?= $_GET['id_client'] ?>" readonly>
                </div>
                <div class="input">
                    <div>
                        <label for="nama_client">Nama Client</label>
                    </div>
                    <input type="text" name="nama_client" id="nama_client" value="<?= $_GET['nama_client'] ?>">
                </div>
                <div class="input">
                    <div>
                        <label for="gender">Gender</label>
                    </div>
                    <select name="gender" id="gender">
                        <option value="Laki-Laki" <?php if (isset($_GET['jenis_kelamin']) && $_GET['jenis_kelamin'] === 'Laki-Laki') echo 'selected'; ?>>Laki-Laki</option>
                        <option value="Perempuan" <?php if (isset($_GET['jenis_kelamin']) && $_GET['jenis_kelamin'] === 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                    </select>
                </div>
                <div class="input">
                    <div>
                        <label for="alamat">Alamat</label>
                    </div>
                    <textarea name="alamat" id="alamat" cols="30" rows="10"><?= $_GET['alamat'] ?></textarea>
                </div>
                <div class="input">
                    <div>
                        <label for="nomor_telepon">Nomor Telepon</label>
                    </div>
                    <input type="number" name="nomor_telepon" id="nomor_telepon" value="<?= $_GET['nomor_telepon'] ?>">
                </div>
                <div class="input">
                    <div>
                        <label for="email">Email</label>
                    </div>
                    <input type="email" name="email" id="email" value="<?= $_GET['email'] ?>">
                </div>
                <div class="input">
                    <div>
                        <label for="tanggal_masuk">Tanggal Masuk</label>
                    </div>
                    <input type="date" name="tanggal_masuk" id="tanggal_masuk" value="<?= $_GET['tanggal_masuk'] ?>">
                </div>
                <div class="input">
                    <div class="input-form">
                        <div>
                            <label for="foto">Foto</label>
                        </div>
                        <input type="file" name="foto" id="foto" onchange="changeImageHalamanUpdateClient(this)" value="<?= $_GET['foto_client'] ?>">
                        <label for="foto" id="pilih-foto">Pilih</label>
                    </div>
                    <div class="image-input">
                        <img src="<?= "../images/" . $_GET['foto_client'] ?>" alt="" width="150px" height="150px" id="image-input-update-client" style="object-fit: contain;">
                    </div>
                </div>
                <div class="input">
                    <div>
                        <label for="status">Status</label>
                    </div>
                    <select name="status" id="status">
                        <option value="Aktif" <?php if (isset($_GET['status']) && $_GET['status'] === 'Aktif') echo 'selected'; ?>>Aktif</option>
                        <option value="Tidak Aktif" <?php if (isset($_GET['status']) && $_GET['status'] === 'Tidak Aktif') echo 'selected'; ?>>Tidak Aktif</option>
                    </select>
                </div>
                <div class="form-submit">
                    <button type="submit" name="update">Update data</button>
                </div>
                <li><input type="hidden" name="foto_lama" value="<?= $_GET['foto_client'] ?>"></li>
            </form>
        </div>
    </div>
    <script src="../js/page-update-client.js"></script>
</body>

</html>