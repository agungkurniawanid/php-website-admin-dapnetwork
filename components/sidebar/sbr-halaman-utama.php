<!DOCTYPE html>
<html lang="in-ID">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/all.css" />
    <link rel="stylesheet" href="css/sbr-halaman-utama.css" />
  </head>

  <body>
    <div class="sub-wrapper-sidebar" id="sub-wrapper-sidebar">
      <!-- ? isi kontent  -->
      <!-- ? pembungkus logo dan title  -->
      <div class="logo-dan-title">
        <div class="logo-title">
          <div class="logo">
            <img
              src="https://i.ibb.co/zZkyGXj/Component-1.png"
              alt="Logo Dapnetwork"
            />
          </div>
          <div class="title-logo">Dapnet</div>
        </div>
        <div class="close"><img src="svg/close.png" alt="" id="close" /></div>
      </div>
      <!-- ? untuk menu item sidebar  -->
      <div class="menu-item-sidebar">
        <ul>
          <li
            id="menu-dashboard"
            onmouseover="changeIconDashboard(this, true)"
            onmouseout="changeIconDashboard(this, false)"
          >
            <img src="svg/dashboard-hover.svg" alt="icon graphic" />&nbsp;
            Dashboard
          </li>
          <li
            id="menu-client"
            onclick="window.location.href = 'dsb-halaman-client.php'"
            onmouseover="changeIconClient(this, true)"
            onmouseout="changeIconClient(this,false)"
          >
            <img src="svg/menu-client.svg" alt="icon client" />&nbsp; Client
          </li>
          <li
            id="menu-product"
            onclick="window.location.href = 'dsb-halaman-product.php'"
            onmouseover="changeIconProduct(this, true)"
            onmouseout="changeIconProduct(this,false)"
          >
            <img src="svg/menu-product.svg" alt="icon" />&nbsp; Product
          </li>
          <li
            id="menu-pegawai"
            onclick="window.location.href = 'dsb-halaman-pegawai.php'"
            onmouseover="changeIconPegawai(this, true) "
            onmouseout="changeIconPegawai(this,false)"
          >
            <img src="svg/menu-pegawai.svg" alt="icon" />&nbsp; Pegawai
          </li>
          <li
            id="menu-paket"
            onclick="window.location.href = 'dsb-paket-layanan.php'"
            onmouseover="changeIconPaket(this, true)"
            onmouseout="changeIconPaket(this,false)"
          >
            <img src="svg/menu-service.svg" alt="icon" />&nbsp; Paket Layanan
          </li>
          <li
            id="menu-pemasukan"
            onclick="window.location.href = 'dsb-halaman-pemasukan.php'"
            onmouseover="changeIconPemasukan(this, true)"
            onmouseout="changeIconPemasukan(this,false)"
          >
            <img src="svg/menu-pemasukan.svg" alt="icon" />&nbsp; Pemasukan
          </li>
          <li
            id="menu-pengeluaran"
            onclick="window.location.href = 'dsb-halaman-pengeluaran.php'"
            onmouseover="changeIconPengeluaran(this, true)"
            onmouseout="changeIconPengeluaran(this,false)"
          >
            <img src="svg/menu-pengeluaran.svg" alt="icon" />&nbsp; Pengeluaran
          </li>
          <li
            id="menu-transaksi"
            onclick="window.location.href = 'dsb-halaman-transaksi.php'"
            onmouseover="changeIconSetting(this, true)"
            onmouseout="changeIconSetting(this,false)"
          >
            <img src="svg/transaksi.svg" alt="icon" />&nbsp; Transaksi
          </li>
          <li
            id="menu-logout"
            onclick="Logout()"
            onmouseover="changeIconLogout(this, true)"
            onmouseout="changeIconLogout(this,false)"
          >
            <img src="svg/menu-logout.svg" alt="icon" />&nbsp; Keluar
          </li>
        </ul>
      </div>
    </div>
    <script src="js/sbr-halaman-utama.js"></script>
  </body>
</html>
