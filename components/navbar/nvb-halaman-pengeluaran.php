<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>

  <body>
    <div class="wrapper-kontent-dan-navigasi">
      <!-- ? untuk kontent navigasi  -->
      <div class="wrapper-navigasi">
        <div class="icon-barmenu">
          <img src="svg/barmenu.png" alt="barmenu" id="barmenu" />
        </div>
        <div class="title-halaman">Pengeluaran</div>
        <div class="profile-dan-icon-informasi">
          <div class="foto-profile-user">
            <div class="foto">
              <img
                src="images/<?= $foto_profile ?>"
                alt="profile user"
              />
              <div>
                <div class="nama-user"><a href="page/page-profile.php?user=<?= $nama_user?>" style="color: black;"><?= $nama_user ?></a></div>
                <div class="hak-akses"><?= $status_user ?></div>
              </div>
            </div>
            <div class="icon-eagle">
              <img src="svg/angle-small-down.svg" alt="icon arrow eagle" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
