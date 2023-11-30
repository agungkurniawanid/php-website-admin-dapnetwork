// tombol 
const btnInsert = document.getElementById("btn");
const btnClose  = document.getElementById("close");

// overlay 
const overlayInsert = document.querySelector(".overlay-modal");

// popup 
const popupInsert = document.querySelector(".container-modal");

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