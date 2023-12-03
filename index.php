<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="stylesheet" href="dist/output.css" />
    <link rel="stylesheet" href="css/all.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="icon" type="image/x-icon" href="ico/dapnetwork.ico"/>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
    <title>Welcome - Dapnetwork</title>
  </head>
  <?php include 'data/keuntungan.php' ?>
  <body>
    <div
      id="overlay"
      class="OVERLAY transition-all duration-300 opacity-0 invisible ease-in-out fixed w-full h-h-100% z-10 bg-overlay-1"
    ></div>
    <div class="CONTAINER w-full h-auto relative px-8 mobile:px-1">
      <header class="w-full h-auto relative">
        <nav
          class="w-full h-auto relative p-8 flex items-center justify-between"
        >
          <div class="LOGO">
            <img
              class="w-48 mobile:w-36 h-auto object-contain"
              src="https://i.imgur.com/Cz52lRv.png"
              alt=""
            />
          </div>
          <div class="MENU">
            <ul
              id="list"
              class="transition-all duration-300 ease-in-out mobile:opacity-0 mobile:invisible flex w-full mobile:flex-col mobile:p-8 mobile:gap-gap-20px mobile:fixed mobile:-left-full mobile:top-0 mobile:bg-white mobile:w-3/5 mobile:h-h-100% z-20 font-poppins"
            >
              <div
                class="close w-full hidden mobile:flex mobile:justify-end"
                id="close"
              >
                <img class="w-5 cursor-pointer" src="ico/cross 1.svg" alt="" />
              </div>
              <li>
                <a
                  href="index.php"
                  class="p-4 text-sm text-black-1 font-poppins-500 hover:bg-gray-1 rounded-md"
                  >Home</a
                >
              </li>
              <li>
                <a
                  href="#layanan"
                  class="scroll-smooth p-4 text-sm text-black-1 font-poppins-500 hover:bg-gray-1 rounded-md"
                  >Layanan</a
                >
              </li>
              <li>
                <a
                  href="ceklokasi.php"
                  class="p-4 text-sm text-black-1 font-poppins-500 hover:bg-gray-1 rounded-md"
                  >Pesan Instalasi</a
                >
              </li>
              <li>
                <a
                  href="bayar-online.php"
                  class="p-4 text-sm text-black-1 font-poppins-500 hover:bg-gray-1 rounded-md"
                  >Bayar Tagihan</a
                >
              </li>
            </ul>
          </div>
          <div class="BTNCONTACT">
            <a
              href="https://wa.me/6281331640909"
              target="_blank"
              class="text-sm py-2 px-4 mobile:text-normal text-white font-poppins-500 bg-blue-1 rounded-md"
              >Hubungi</a
            >
          </div>
          <div class="barmenu w-fit hidden mobile:block">
            <img
              id="barmenu"
              class="w-8 object-cover h-8"
              src="ico/align-justify 1.svg"
              alt=""
            />
          </div>
        </nav>
      </header>
      <main
        class="grid grid-cols-2 mobile:flex mobile:flex-col-reverse p-8 gap-5"
      >
        <div class="CONTENT1">
          <h1
            class="text-5xl mobile:text-3xl mobile:w-full mobile:text-center font-poppins-800"
          >
            Aktifitas apapun dengan internet cepat kami
          </h1>
          <p class="mt-4 mobile:text-center font-poppins-500">
            Menikmati segala aktivitas dengan koneksi internet, dari
            penjelajahan dunia maya hingga mendalami hobi. Temukan kebebasan
            eksplorasi dan pembelajaran dengan akses yang tak terbatas.
          </p>
          <div
            class="flex gap-gap-20px mobile:gap-0 mobile:flex-col justify-between mobile:mt-8"
          >
            <a
              href="ceklokasi.php"
              class="BUTTON bg-blue-2 rounded-3xl p-4 w-2/4 mobile:w-full mt-8 mobile:mt-2 flex items-center justify-between"
            >
              <div
                class="text-blue-700 font-poppins-500 bg-white py-2 px-4 rounded-full"
              >
                add
              </div>
              <div class="text-white font-poppins-500">Pesan Sekarang!</div>
              <div>
                <img
                  class="object-contain bg-blue-trans-1 p-3 rounded-full w-12"
                  src="ico/angle-small-right (1) 1.svg"
                  alt=""
                />
              </div>
            </a>
            <a
              href="pembatalan.php"
              class="BUTTON bg-red-1 rounded-3xl p-4 w-2/4 mobile:w-full mt-8 mobile:mt-2 flex items-center justify-between"
            >
              <div
                class="text-red-1 font-poppins-500 bg-white py-2 px-4 rounded-full"
              >
                add
              </div>
              <div class="text-white font-poppins-500">Pembatalan!</div>
              <div>
                <img
                  class="object-contain bg-red-trans-1 p-3 rounded-full w-12"
                  src="ico/angle-small-right 2.svg"
                  alt=""
                />
              </div>
            </a>
          </div>
        </div>
        <div class="CONTENT2">
          <div class="w-full flex justify-center items-center">
            <img
              class="object-cover w-3/4"
              src="https://i.imgur.com/5uWAjDE.png"
              alt="GLOBE"
            />
          </div>
        </div>
      </main>
      <section class="w-full p-8 select-none">
        <div
          class="w-full flex justify-center font-poppins-800 text-3xl capitalize"
        >
          <h1 id="layanan">Layanan internet</h1>
        </div>
        <div
          class="CONTAINER-CARD w-full grid grid-cols-3 mobile:grid-cols-1 mobile:gap-2 gap-gap-20px mt-8"
        >
          <?php foreach ($CARD_PAKET as $card) : ?>
          <div
            class="WRAPPERCARD w-full shadow-box-shadow-1 relative rounded-2xl p-8 mobile:h-h-otomatis h-h-650 flex flex-col justify-between"
            id="wrapper-card-layanan"
          >
            <div>
              <div class="flex items-center gap-gap-10px">
                <div>
                  <img
                    class="w-5 object-cover"
                    src="<?= $card['icon'] ?>"
                    alt=""
                  />
                </div>
                <div class="font-poppins-500 text-normal">
                  <?= $card['text-icon'] ?>
                </div>
              </div>
              <h1 class="text-4xl font-poppins-500"><?= $card['paket'] ?></h1>
              <div class="mt-2">
                <span class="font-poppins-800 text-high"
                  ><?= $card['harga'] ?></span
                >
                <span class="text-normal font-poppins-600">/ bulan</span>
              </div>
              <?php foreach ($card['keuntungan'] as $keuntungan) : ?>
              <div class="KEUNTUNGAN flex items-start mt-4">
                <img src="ico/check-circle 1.svg" class="w-7" alt="" />
                <p class="font-poppins text-normales ml-2">
                  <?= $keuntungan ?>
                </p>
              </div>
              <?php endforeach ?>
            </div>
            <div class="w-full">
              <button
                onclick="window.location.href='<?= $card['link'] ?>'"
                class="w-full bg-blue-2 p-4 mt-4 text-white rounded-md text-normales font-poppins-600"
              >
                Pesan
              </button>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </section>
      <footer
        class="w-full p-8 flex justify-center items-center rounded-3xl shadow-box-shadow-1"
      >
        <div>
          <div class="logo flex justify-center">
            <img
              class="w-48"
              src="https://i.imgur.com/Cz52lRv.png"
              alt=""
            />
          </div>
          <div
            class="alamat flex items-center mobile:flex-col justify-center mt-4"
          >
            <img class="w-5" src="ico/marker 1.svg" alt="" />
            <p class="ml-2 mobile:ml-1 font-poppins text-normal text-center">
              <a
                href="https://maps.app.goo.gl/3TyvFoqj6FDZ9Jpx6"
                target="_blank"
                >Dusun Cawang, Desa Benelan Kidul, Kecamatan Rogojampi</a
              >
            </p>
          </div>
          <div class="nomor flex justify-center items-center mt-4">
            <img class="w-5" src="ico/phone-rotary.svg" alt="" />
            <p>
              <a
                class="ml-2 font-poppins text-normal"
                href="https://wa.me/6281331640909"
                target="_blank"
                >0813-3164-0909</a
              >
            </p>
          </div>
          <div class="email flex justify-center items-center mt-4">
            <img class="w-5" src="ico/envelope-dot.svg" alt="" />
            <p>
              <a
                class="ml-2 font-poppins text-normal"
                href="mailto:agungklewang26@gmail.com"
                target="_blank"
                >dapnetwork@gmail.com</a
              >
            </p>
          </div>
          <p class="text-center mt-6 font-poppins-500 text-normal">
            Copyright © 2023 Dapnetwork
          </p>
        </div>
      </footer>
    </div>
    <script>
      const barMenu = document.getElementById("barmenu");
      const close = document.getElementById("close");
      const menu = document.getElementById("list");
      const overlay = document.getElementById("overlay");

      let condition = false;

      barMenu.addEventListener("click", () => {
        if (!condition) {
          overlay.style.opacity = "1";
          overlay.style.visibility = "visible";
          menu.style.left = "0%";
          menu.style.opacity = "1";
          menu.style.visibility = "visible";
          condition = true;
        }

        overlay.addEventListener("click", () => {
          hideOverlay();
        });

        close.addEventListener("click", () => {
          hideOverlay();
        });
      });

      const hideOverlay = () => {
        if (overlay && menu) {
          overlay.style.opacity = "0";
          overlay.style.visibility = "hidden";
          menu.style.left = "-100%";
          menu.style.opacity = "0";
          menu.style.visibility = "hidden";
          condition = false;
        }
      };
    </script>
  </body>
</html>
