<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/page-halaman-product.css">
    <link rel="icon" type="image/x-icon" href="ico/dapnetwork.ico" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<?php
require 'function/connection.php';
$SQL_SELECT_PRODUCT_ROUTER = mysqli_query($connection_database, "SELECT * FROM tb_product WHERE kategori_product = 'Router' order by harga_product asc");
$SQL_SELECT_PRODUCT_CONVERTER = mysqli_query($connection_database, "SELECT * FROM tb_product WHERE kategori_product = 'Converter'");
$SQL_SELECT_PRODUCT_PATCHCORE = mysqli_query($connection_database, "SELECT * FROM tb_product WHERE kategori_product = 'Patch Core'");
$SQL_SELECT_PRODUCT_LAN = mysqli_query($connection_database, "SELECT * FROM tb_product WHERE kategori_product = 'LAN'");
$SQL_SELECT_PRODUCT_POWER = mysqli_query($connection_database, "SELECT * FROM tb_product WHERE kategori_product = 'Power Supply'");
$SQL_SELECT_PRODUCT_SWITCH = mysqli_query($connection_database, "SELECT * FROM tb_product WHERE kategori_product = 'Switch Hub'");
$SQL_SELECT_PRODUCT_CONNECTOR = mysqli_query($connection_database, "SELECT * FROM tb_product WHERE kategori_product = 'Connector'");
$SQL_SELECT_PRODUCT_SPLITTER = mysqli_query($connection_database, "SELECT * FROM tb_product WHERE kategori_product = 'Splitter'");
?>

<body>
    <div class="wrapper-page-halaman-product">
        <div style="display: grid; gap: 10px; width: 100%; grid-template-columns: 1fr 1fr 1fr;">
            <div class="component-button-add-product">
                <button id="button-add-product">
                    <div class="icon-text">
                        <div class="icon">add</div>
                        <div class="text">Tambah Product baru</div>
                    </div>
                    <div class="icon-arrow"><img src="svg/angle-small-right (1) 1.svg" alt="arrow icon"></div>
                </button>
            </div>
            <div class="component-button-add-product">
                <button onclick="window.location.href='page/page-product-masuk.php'">
                    <div class="icon-text">
                        <div class="icon">cek</div>
                        <div class="text">Product Masuk</div>
                    </div>
                    <div class="icon-arrow"><img src="svg/angle-small-right (1) 1.svg" alt="arrow icon"></div>
                </button>
            </div>
            <div class="component-button-add-product">
                <button onclick="window.location.href='page/page-product-keluar.php'">
                    <div class="icon-text">
                        <div class="icon">cek</div>
                        <div class="text">Product Keluar</div>
                    </div>
                    <div class="icon-arrow"><img src="svg/angle-small-right (1) 1.svg" alt="arrow icon"></div>
                </button>
            </div>
        </div>

        <div class="component-list-product">
            <p>List Product</p>
            <div class="list">
                <a href="#router">Router</a>
                <a href="#converter">Converter</a>
                <a href="#patchcore">Patch Core</a>
                <a href="#lan">LAN</a>
                <a href="#powersupply">Power Supply</a>
                <a href="#switchhub">Switch Hub</a>
                <a href="#connector">Connector</a>
                <a href="#splitter">Splitter</a>
            </div>
        </div>

        <div class="component-router">
            <div class="header">
                <p id="router">Router</p>
                <div class="search-input">
                    <div class="icon-search">
                        <img src="svg/search.svg" alt="icon cari" />
                    </div>
                    <div class="input">
                        <input type="search" placeholder="Cari Router" oninput="cariRouter(this.value)" name="cariRouter" />
                    </div>
                </div>
            </div>
            <?php if (mysqli_num_rows($SQL_SELECT_PRODUCT_ROUTER) > 0) : ?>
                <div class="body bodyrouter">
                    <?php foreach ($SQL_SELECT_PRODUCT_ROUTER as $router) : ?>
                        <a class="wrapper-router" href="page/page-update-product.php?nama_product=<?= $router['nama_product'] ?>">
                            <div class="gambar-router"><img src="images/<?= $router['gambar_product'] ?>" alt="router">
                                <p><?= $router['status_product'] ?></p>
                            </div>
                            <div class="name-id">
                                <p><?= $router['nama_product'] ?></p>
                            </div>
                            <div class="id-product">Rp. <?= number_format($router['harga_product'], 0, ',', '.'); ?></div>
                            <div class="kategori">
                                <p>Kategori</p>
                                <p><?= $router['kategori_product'] ?></p>
                            </div>
                            <div class="merek">
                                <p>merek</p>
                                <p><?= $router['merek_product'] ?></p>
                            </div>
                            <div class="stok">
                                <p>Stok Barang</p>
                                <p><?= $router['stok_product'] ?> Pcs</p>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="body" style="width: 100%; display: flex; justify-content: center; align-items: center;">
                    <div>
                        <div class="img-notdata-produk"><img src="svg/404.svg" alt="404"></div>
                        <p style="text-align: center;">Oopss... Data tidak ditemukan &#x1F622;</p>
                    </div>
                </div>
            <?php endif ?>
        </div>
        <div class="component-router">
            <div class="header">
                <p id="converter">Converter</p>
                <div class="search-input">
                    <div class="icon-search">
                        <img src="svg/search.svg" alt="icon cari" />
                    </div>
                    <div class="input">
                        <input type="search" oninput="cariConverter(this.value)" placeholder="Search" name="search" />
                    </div>
                </div>
            </div>

            <?php if (mysqli_num_rows($SQL_SELECT_PRODUCT_CONVERTER) > 0) : ?>
                <div class="body bodyconverter">
                    <?php foreach ($SQL_SELECT_PRODUCT_CONVERTER as $converter) : ?>
                        <a class="wrapper-router" href="page/page-update-product.php?nama_product=<?= $converter['nama_product'] ?>">
                            <div class="gambar-router"><img src="images/<?= $converter['gambar_product'] ?>" alt="router">
                                <p><?= $converter['status_product'] ?></p>
                            </div>
                            <div class="name-id">
                                <p><?= $converter['nama_product'] ?></p>
                            </div>
                            <div class="id-product">Rp. <?= number_format($converter['harga_product'], 0, ',', '.'); ?></div>
                            <div class="kategori">
                                <p>Kategori</p>
                                <p><?= $converter['kategori_product'] ?></p>
                            </div>
                            <div class="merek">
                                <p>merek</p>
                                <p><?= $converter['merek_product'] ?></p>
                            </div>
                            <div class="stok">
                                <p>Stok Barang</p>
                                <p><?= $converter['stok_product'] ?> Pcs</p>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="body" style="width: 100%; display: flex; justify-content: center; align-items: center;">
                    <div>
                        <div class="img-notdata-produk"><img src="svg/404.svg" alt="404"></div>
                        <p style="text-align: center;">Oopss... Data tidak ditemukan &#x1F622;</p>
                    </div>
                </div>
            <?php endif ?>
        </div>

        <div class="component-router">
            <div class="header">
                <p id="patchcore">Patch Core</p>
                <div class="search-input">
                    <div class="icon-search">
                        <img src="svg/search.svg" alt="icon cari" />
                    </div>
                    <div class="input">
                        <input type="search" oninput="cariCore(this.value)" placeholder="Search" name="search" />
                    </div>
                </div>
            </div>

            <?php if (mysqli_num_rows($SQL_SELECT_PRODUCT_PATCHCORE) > 0) : ?>
                <div class="body bodycore">
                    <?php foreach ($SQL_SELECT_PRODUCT_PATCHCORE as $pc) : ?>
                        <a class="wrapper-router" href="page/page-update-product.php?nama_product=<?= $pc['nama_product'] ?>">
                            <div class="gambar-router"><img src="images/<?= $pc['gambar_product'] ?>" alt="router">
                                <p><?= $pc['status_product'] ?></p>
                            </div>
                            <div class="name-id">
                                <p><?= $pc['nama_product'] ?></p>
                            </div>
                            <div class="id-product">Rp. <?= number_format($pc['harga_product'], 0, ',', '.'); ?></div>
                            <div class="kategori">
                                <p>Kategori</p>
                                <p><?= $pc['kategori_product'] ?></p>
                            </div>
                            <div class="merek">
                                <p>merek</p>
                                <p><?= $pc['merek_product'] ?></p>
                            </div>
                            <div class="stok">
                                <p>Stok Barang</p>
                                <p><?= $pc['stok_product'] ?> Pcs</p>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="body" style="width: 100%; display: flex; justify-content: center; align-items: center;">
                    <div>
                        <div class="img-notdata-produk"><img src="svg/404.svg" alt="404"></div>
                        <p style="text-align: center;">Oopss... Data tidak ditemukan &#x1F622;</p>
                    </div>
                </div>
            <?php endif ?>
        </div>


        <div class="component-router">
            <div class="header">
                <p id="lan">LAN</p>
                <div class="search-input">
                    <div class="icon-search">
                        <img src="svg/search.svg" alt="icon cari" />
                    </div>
                    <div class="input">
                        <input type="search" oninput="cariLan(this.value)" placeholder="Search" name="search" />
                    </div>
                </div>
            </div>
            <?php if (mysqli_num_rows($SQL_SELECT_PRODUCT_LAN) > 0) : ?>
                <div class="body bodylan">
                    <?php foreach ($SQL_SELECT_PRODUCT_LAN as $lan) : ?>
                        <a class="wrapper-router" href="page/page-update-product.php?nama_product=<?= $lan['nama_product'] ?>">
                            <div class="gambar-router"><img src="images/<?= $lan['gambar_product'] ?>" alt="router">
                                <p><?= $lan['status_product'] ?></p>
                            </div>
                            <div class="name-id">
                                <p><?= $lan['nama_product'] ?></p>
                            </div>
                            <div class="id-product">Rp. <?= number_format($lan['harga_product'], 0, ',', '.'); ?></div>
                            <div class="kategori">
                                <p>Kategori</p>
                                <p><?= $lan['kategori_product'] ?></p>
                            </div>
                            <div class="merek">
                                <p>merek</p>
                                <p><?= $lan['merek_product'] ?></p>
                            </div>
                            <div class="stok">
                                <p>Stok Barang</p>
                                <p><?= $lan['stok_product'] ?> Pcs</p>
                            </div>
                        </a>
                    <?php endforeach ?>
                </div>
            <?php else : ?>
                <div class="body" style="width: 100%; display: flex; justify-content: center; align-items: center;">
                    <div>
                        <div class="img-notdata-produk"><img src="svg/404.svg" alt="404"></div>
                        <p style="text-align: center;">Oopss... Data tidak ditemukan &#x1F622;</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="component-router">
            <div class="header">
                <p id="powersupply">Power Supply</p>
                <div class="search-input">
                    <div class="icon-search">
                        <img src="svg/search.svg" alt="icon cari" />
                    </div>
                    <div class="input">
                        <input type="search" oninput="cariPower(this.value)" placeholder="Search" name="search" />
                    </div>
                </div>
            </div>
            <?php if (mysqli_num_rows($SQL_SELECT_PRODUCT_POWER) > 0) : ?>
                <div class="body bodypower">
                    <?php foreach ($SQL_SELECT_PRODUCT_POWER as $ps) : ?>
                        <a class="wrapper-router" href="page/page-update-product.php?nama_product=<?= $ps['nama_product'] ?>">
                            <div class="gambar-router"><img src="images/<?= $ps['gambar_product'] ?>" alt="router">
                                <p><?= $ps['status_product'] ?></p>
                            </div>
                            <div class="name-id">
                                <p><?= $ps['nama_product'] ?></p>
                            </div>
                            <div class="id-product">Rp. <?= number_format($ps['harga_product'], 0, ',', '.'); ?></div>
                            <div class="kategori">
                                <p>Kategori</p>
                                <p><?= $ps['kategori_product'] ?></p>
                            </div>
                            <div class="merek">
                                <p>merek</p>
                                <p><?= $ps['merek_product'] ?></p>
                            </div>
                            <div class="stok">
                                <p>Stok Barang</p>
                                <p><?= $ps['stok_product'] ?> Pcs</p>
                            </div>
                        </a>
                    <?php endforeach ?>

                </div>
            <?php else : ?>
                <div class="body" style="width: 100%; display: flex; justify-content: center; align-items: center;">
                    <div>
                        <div class="img-notdata-produk"><img src="svg/404.svg" alt="404"></div>
                        <p style="text-align: center;">Oopss... Data tidak ditemukan &#x1F622;</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="component-router">
            <div class="header">
                <p id="switchhub">Switch Hub</p>
                <div class="search-input">
                    <div class="icon-search">
                        <img src="svg/search.svg" alt="icon cari" />
                    </div>
                    <div class="input">
                        <input type="search" oninput="cariSwitch(this.value)" placeholder="Search" name="search" />
                    </div>
                </div>
            </div>
            <?php if (mysqli_num_rows($SQL_SELECT_PRODUCT_SWITCH) > 0) : ?>
                <div class="body bodyswitch">
                    <?php foreach ($SQL_SELECT_PRODUCT_SWITCH as $sh) : ?>
                        <a class="wrapper-router" href="page/page-update-product.php?nama_product=<?= $sh['nama_product'] ?>">
                            <div class="gambar-router"><img src="images/<?= $sh['gambar_product'] ?>" alt=" router">
                                <p><?= $sh['status_product'] ?></p>
                            </div>
                            <div class="name-id">
                                <p><?= $sh['nama_product'] ?></p>
                            </div>
                            <div class="id-product">Rp. <?= number_format($sh['harga_product'], 0, ',', '.'); ?></div>
                            <div class="kategori">
                                <p>Kategori</p>
                                <p><?= $sh['kategori_product'] ?></p>
                            </div>
                            <div class="merek">
                                <p>merek</p>
                                <p><?= $sh['merek_product'] ?></p>
                            </div>
                            <div class="stok">
                                <p>Stok Barang</p>
                                <p><?= $sh['stok_product'] ?> Pcs</p>
                            </div>
                        </a>
                    <?php endforeach ?>
                </div>
            <?php else : ?>
                <div class="body" style="width: 100%; display: flex; justify-content: center; align-items: center;">
                    <div>
                        <div class="img-notdata-produk"><img src="svg/404.svg" alt="404"></div>
                        <p style="text-align: center;">Oopss... Data tidak ditemukan &#x1F622;</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="component-router">
            <div class="header">
                <p id="connector">Connector</p>
                <div class="search-input">
                    <div class="icon-search">
                        <img src="svg/search.svg" alt="icon cari" />
                    </div>
                    <div class="input">
                        <input type="search" oninput="cariConnector(this.value)" placeholder="Search" name="search" />
                    </div>
                </div>
            </div>
            <?php if (mysqli_num_rows($SQL_SELECT_PRODUCT_CONNECTOR) > 0) : ?>
                <div class="body bodyconnector">
                    <?php foreach ($SQL_SELECT_PRODUCT_CONNECTOR as $cn) : ?>
                        <a class="wrapper-router" href="page/page-update-product.php?nama_product=<?= $cn['nama_product'] ?>">
                            <div class="gambar-router"><img src="images/<?= $cn['gambar_product'] ?>" alt="router">
                                <p><?= $cn['status_product'] ?></p>
                            </div>
                            <div class="name-id">
                                <p><?= $cn['nama_product'] ?></p>
                            </div>
                            <div class="id-product">Rp. <?= number_format($cn['harga_product'], 0, ',', '.'); ?></div>
                            <div class="kategori">
                                <p>Kategori</p>
                                <p><?= $cn['kategori_product'] ?></p>
                            </div>
                            <div class="merek">
                                <p>merek</p>
                                <p><?= $cn['merek_product'] ?></p>
                            </div>
                            <div class="stok">
                                <p>Stok Barang</p>
                                <p><?= $cn['stok_product'] ?> Pcs</p>
                            </div>
                        </a>
                    <?php endforeach ?>
                </div>
            <?php else : ?>
                <div class="body" style="width: 100%; display: flex; justify-content: center; align-items: center;">
                    <div>
                        <div class="img-notdata-produk"><img src="svg/404.svg" alt="404"></div>
                        <p style="text-align: center;">Oopss... Data tidak ditemukan &#x1F622;</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="component-router">
            <div class="header">
                <p id="splitter">Splitter</p>
                <div class="search-input">
                    <div class="icon-search">
                        <img src="svg/search.svg" alt="icon cari" />
                    </div>
                    <div class="input">
                        <input type="search" oninput="cariSplitter(this.value)" placeholder="Search" name="search" />
                    </div>
                </div>
            </div>
            <?php if (mysqli_num_rows($SQL_SELECT_PRODUCT_SPLITTER) > 0) : ?>
                <div class="body bodysplitter">
                    <?php foreach ($SQL_SELECT_PRODUCT_SPLITTER as $spl) : ?>
                        <a class="wrapper-router" href="page/page-update-product.php?nama_product=<?= $spl['nama_product'] ?>">
                            <div class="gambar-router"><img src="images/<?= $spl['gambar_product'] ?>" alt="router">
                                <p><?= $spl['status_product'] ?></p>
                            </div>
                            <div class="name-id">
                                <p><?= $spl['nama_product'] ?></p>
                            </div>
                            <div class="id-product">Rp. <?= number_format($spl['harga_product'], 0, ',', '.'); ?></div>
                            <div class="kategori">
                                <p>Kategori</p>
                                <p><?= $spl['kategori_product'] ?></p>
                            </div>
                            <div class="merek">
                                <p>merek</p>
                                <p><?= $spl['merek_product'] ?></p>
                            </div>
                            <div class="stok">
                                <p>Stok Barang</p>
                                <p><?= $spl['stok_product'] ?> Pcs</p>
                            </div>
                        </a>
                    <?php endforeach ?>
                </div>
            <?php else : ?>
                <div class="body" style="width: 100%; display: flex; justify-content: center; align-items: center;">
                    <div>
                        <div class="img-notdata-produk"><img src="svg/404.svg" alt="404"></div>
                        <p style="text-align: center;">Oopss... Data tidak ditemukan &#x1F622;</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function cariRouter(keyword) {
            $.ajax({
                type: 'POST',
                url: 'function/cari-product-router.php', // Sesuaikan dengan nama file yang tepat
                data: {
                    keyword: keyword
                },
                success: function(data) {
                    $('.bodyrouter').html(data);
                }
            });
        }

        function cariConverter(keyword) {
            $.ajax({
                type: 'POST',
                url: 'function/cari-product-converter.php', // Sesuaikan dengan nama file yang tepat
                data: {
                    keyword: keyword
                },
                success: function(data) {
                    $('.bodyconverter').html(data);
                }
            });
        }

        function cariCore(keyword) {
            $.ajax({
                type: 'POST',
                url: 'function/cari-product-patchcore.php', // Sesuaikan dengan nama file yang tepat
                data: {
                    keyword: keyword
                },
                success: function(data) {
                    $('.bodycore').html(data);
                }
            });
        }

        function cariLan(keyword) {
            $.ajax({
                type: 'POST',
                url: 'function/cari-product-lan.php', // Sesuaikan dengan nama file yang tepat
                data: {
                    keyword: keyword
                },
                success: function(data) {
                    $('.bodylan').html(data);
                }
            })
        }

        function cariPower(keyword) {
            $.ajax({
                type: 'POST',
                url: 'function/cari-product-power.php', // Sesuaikan dengan nama file yang tepat
                data: {
                    keyword: keyword
                },
                success: function(data) {
                    $('.bodypower').html(data);
                }
            })
        }

        function cariSwitch(keyword) {
            $.ajax({
                type: 'POST',
                url: 'function/cari-product-switch.php', // Sesuaikan dengan nama file yang tepat
                data: {
                    keyword: keyword
                },
                success: function(data) {
                    $('.bodyswitch').html(data);
                }
            })
        }

        function cariConnector(keyword) {
            $.ajax({
                type: 'POST',
                url: 'function/cari-product-connector.php', // Sesuaikan dengan nama file yang tepat
                data: {
                    keyword: keyword
                },
                success: function(data) {
                    $('.bodyconnector').html(data);
                }
            })
        }

        function cariSplitter(keyword) {
            $.ajax({
                type: 'POST',
                url: 'function/cari-product-splitter.php', // Sesuaikan dengan nama file yang tepat
                data: {
                    keyword: keyword
                },
                success: function(data) {
                    $('.bodysplitter').html(data);
                }
            })
        }
    </script>
</body>

</html>