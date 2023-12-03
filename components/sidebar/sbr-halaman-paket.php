<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="sub-wrapper-sidebar" id="sub-wrapper-sidebar">
        <!-- ? isi kontent  -->
        <!-- ? pembungkus logo dan title  -->
        <div class="logo-dan-title">
            <div class="logo-title">
                <div class="logo">
                    <img src="https://i.imgur.com/e7vaNMr.png" alt="Logo Dapnetwork" />
                </div>
                <div class="title-logo">Dapnet</div>
            </div>
            <div class="close"><img src="svg/close.png" alt="" id="close" /></div>
        </div>
        <!-- ? untuk menu item sidebar  -->
        <div class="menu-item-sidebar">
            <ul>
                <li id="menu-dashboard" onclick="window.location.href = 'dsb-halaman-utama.php'" onmouseover="changeIconDashboard(this, true)" onmouseout="changeIconDashboard(this, false)">
                    <img src="svg/dashboard.svg" alt="icon graphic" />&nbsp; Dashboard
                </li>
                <li id="menu-client" onclick="window.location.href = 'dsb-halaman-client.php'" onmouseover="changeIconClient(this, true)" onmouseout="changeIconClient(this,false)">
                    <img src="svg/menu-client.svg" alt="icon client" />&nbsp;
                    Client
                </li>
                <li id="menu-product" onclick="window.location.href = 'dsb-halaman-product.php'" onmouseover="changeIconProduct(this, true)" onmouseout="changeIconProduct(this,false)">
                    <img src="svg/menu-product.svg" alt="icon" />&nbsp; Product
                </li>
                <li id="menu-pegawai" onmouseover="changeIconPegawai(this, true) " onclick="window.location.href = 'dsb-halaman-pegawai.php'" onmouseout="changeIconPegawai(this,false)">
                    <img src="svg/menu-pegawai.svg" alt="icon" />&nbsp; Pegawai
                </li>
                <li id="menu-paket" onmouseover="changeIconPaket(this, true)" onclick="window.location.href = 'dsb-paket-layanan.php'" onmouseout="changeIconPaket(this,false)">
                    <img src="svg/menu-service-hover.svg" alt="icon" />&nbsp; Paket Layanan
                </li>
                <li id="menu-pemasukan" onmouseover="changeIconPemasukan(this, true)" onclick="window.location.href = 'dsb-halaman-pemasukan.php'" onmouseout="changeIconPemasukan(this,false)">
                    <img src="svg/menu-pemasukan.svg" alt="icon" />&nbsp; Pemasukan
                </li>
                <li id="menu-pengeluaran" onmouseover="changeIconPengeluaran(this, true)" onclick="window.location.href = 'dsb-halaman-pengeluaran.php'" onmouseout="changeIconPengeluaran(this,false)">
                    <img src="svg/menu-pengeluaran.svg" alt="icon" />&nbsp; Pengeluaran
                </li>
                <li id="menu-transaksi" onmouseover="changeIconSetting(this, true)" onclick="window.location.href = 'dsb-halaman-transaksi.php'" onmouseout="changeIconSetting(this,false)">
                    <img src="svg/transaksi.svg" alt="icon" />&nbsp; Transaksi
                </li>
                <li id="menu-logout" onclick="Logout()" onmouseover="changeIconLogout(this, true)" onmouseout="changeIconLogout(this,false)">
                    <img src="svg/menu-logout.svg" alt="icon" />&nbsp; Keluar
                </li>
            </ul>
        </div>
    </div>
</body>

</html>