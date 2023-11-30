// tombol 
const btnInsert = document.getElementById("button-add-product");
const btnClose  = document.getElementById("wip-close");

// overlay 
const overlayInsert = document.querySelector(".overlay-popup-insert-product");

// popup 
const popupInsert = document.querySelector(".wrapper-insert-product");

// konsidi
let boolShowPopupForm = false;

// function 
btnInsert.addEventListener("click", () => {
    if(!boolShowPopupForm) {
        overlayInsert.style.opacity = "1";
        overlayInsert.style.visibility = "visible";
        popupInsert.style.top = "50%";
        popupInsert.style.opacity = "1";
        popupInsert.style.visibility = "visible";
        boolShowPopupForm = true;
    }
    overlayInsert.addEventListener("click", () => {
        hideOverlay();
    })
    btnClose.addEventListener("click", () => {
        hideOverlay();
    })
});

const hideOverlay = () => {
    if(overlayInsert && popupInsert) {
        overlayInsert.style.opacity = "0";
        overlayInsert.style.visibility = "hidden";
        popupInsert.style.top = "-100%";
        popupInsert.style.opacity = "0";
        popupInsert.style.visibility = "hidden";
        boolShowPopupForm = false;
    }
}

function changeImageFormProduk(input) {
    const fileInput = input.files[0];
    if (fileInput) {
      const reader = new FileReader();
  
      reader.onload = function (e) {
        const imageElement = document.getElementById("image-form-produk");
        imageElement.src = e.target.result;
      };
  
      reader.readAsDataURL(fileInput);
    }
  }