<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    <div class="container-card">
      <?php require 'data/card-informasi-client.php'?>
      <?php foreach ($card_informasi_client as $informasi_client) : ?>
      <div
        class="wrapper-card-informasi transition"
        style="background-color: <?= $informasi_client[ 'backgoround-color'] ?>"
      >
        <div class="card">
          <div class="heading">
            <div
              class="title"
              style="color: <?php echo $informasi_client[ 'color']?>"
            >
              <?php echo $informasi_client['title1'] ?>
            </div>
            <div
              class="title"
              style="color: <?php echo $informasi_client[ 'color']?>"
            >
              <?php echo $informasi_client['title2'] ?>
            </div>
          </div>
          <div class="footer">
            <div class="informasi-total-client">
              <div class="image">
                <img
                  src="https://i.ibb.co/48WyDd6/Group-3.png"
                  alt="icon-male"
                />
                <img
                  src="https://i.ibb.co/T1HvPHv/Group-2.png"
                  alt="icon-female"
                />
              </div>
              <div class="name-total">
                <div
                  class="name"
                  style="color: <?php echo $informasi_client[ 'color']?>"
                >
                  Total client
                </div>
                <div
                  class="total"
                  style="color: <?php echo $informasi_client[ 'color']?>"
                >
                  <?= $informasi_client['total'] ?> Client
                </div>
              </div>
            </div>
            <div class="button">
              <a
                href="<?= $informasi_client['link'] ?>"
                style="
                  background-color: <?php echo $informasi_client[ 'color']?>;
                "
                >Cek client
                <div><img src="svg/angle-circle-right.svg" alt="" /></div
              ></a>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach ?>
    </div>
  </body>
</html>
