// ? untuk hover dan no hover menu item sidebar
// * icon client
const changeIconDashboard = (element, kondisi) => {
    var imgElement = element.querySelector("img");
    if (kondisi) {
      imgElement.src = "svg/dashboard-hover.svg";
    } else {
      imgElement.src = "svg/dashboard.svg";
    }
  };
  
  // * icon product
  const changeIconClient = (element, kondisi) => {
    var imgElement = element.querySelector("img");
    if (kondisi) {
      imgElement.src = "svg/menu-client-hover.svg";
    } else {
      imgElement.src = "svg/menu-client.svg";
    }
  };
  
  // * icon pegawai
  const changeIconProduct = (element, kondisi) => {
    var imgElement = element.querySelector("img");
    if (kondisi) {
      imgElement.src = "svg/menu-product-hover.svg";
    } else {
      imgElement.src = "svg/menu-product.svg";
    }
  };
  
  // * icon paket
  const changeIconPaket = (element, kondisi) => {
    var imgElement = element.querySelector("img");
    if (kondisi) {
      imgElement.src = "svg/menu-service-hover.svg";
    } else {
      imgElement.src = "svg/menu-service.svg";
    }
  };
  
  // * icon pemasukan
  const changeIconPemasukan = (element, kondisi) => {
    var imgElement = element.querySelector("img");
    if (kondisi) {
      imgElement.src = "svg/menu-pemasukan-hover.svg";
    } else {
      imgElement.src = "svg/menu-pemasukan.svg";
    }
  };
  
  // * icon pengeluaran
  const changeIconPengeluaran = (element, kondisi) => {
    var imgElement = element.querySelector("img");
    if (kondisi) {
      imgElement.src = "svg/menu-pengeluaran-hover.svg";
    } else {
      imgElement.src = "svg/menu-pengeluaran.svg";
    }
  };
  
  // * icon setting
  const changeIconSetting = (element, kondisi) => {
    var imgElement = element.querySelector("img");
    if (kondisi) {
      imgElement.src = "svg/transaksi-hover.svg";
    } else {
      imgElement.src = "svg/transaksi.svg";
    }
  };
  
  // * icon logout
  const changeIconLogout = (element, kondisi) => {
    var imgElement = element.querySelector("img");
    if (kondisi) {
      imgElement.src = "svg/menu-logout-hover.svg";
    } else {
      imgElement.src = "svg/menu-logout.svg";
    }
  };
  
  // ? untuk logout
  const logout = document.getElementById("menu-logout");
  logout.addEventListener("click", () => {
    console.log("Clicked on logout");
    window.location.href = "function/logout.php";
  });
  