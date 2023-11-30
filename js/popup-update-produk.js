// tombol 
const btnupdate = document.getElementById("btnUpdate");
const btnClose  = document.getElementById("wup-close");

// overlay 
const overlayupdate = document.querySelector(".overlay-popup-update-product");

// popup 
const popupupdate = document.querySelector(".wup-wrapper-update-product");

// konsidi
let boolShowPopupForm = false;

// function 
btnupdate.addEventListener("click", () => {
    if(!boolShowPopupForm) {
        overlayupdate.style.opacity = "1";
        overlayupdate.style.visibility = "visible";
        popupupdate.style.top = "50%";
        popupupdate.style.opacity = "1";
        popupupdate.style.visibility = "visible";
        boolShowPopupForm = true;
    }
    overlayupdate.addEventListener("click", () => {
        hideOverlay();
    })
    btnClose.addEventListener("click", () => {
        hideOverlay();
    })
});

const hideOverlay = () => {
    if(overlayupdate && popupupdate) {
        overlayupdate.style.opacity = "0";
        overlayupdate.style.visibility = "hidden";
        popupupdate.style.top = "-100%";
        popupupdate.style.opacity = "0";
        popupupdate.style.visibility = "hidden";
        boolShowPopupForm = false;
    }
}

function changeImageFormUpdateProduk(input) {
    const fileInput = input.files[0];
    if (fileInput) {
      const reader = new FileReader();
  
      reader.onload = function (e) {
        const imageElement = document.getElementById("wup-image-form-produk");
        imageElement.src = e.target.result;
      };
  
      reader.readAsDataURL(fileInput);
    }
  }