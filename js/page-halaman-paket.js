const btnClose = document.getElementById("btn-close-form-paket");
const btnShowFormPegawai = document.getElementById("tambah-paket");
const overlayFormPegawai = document.querySelector(".overlay-popup-insert-paket");
const formPegawai = document.querySelector(".container-popup-insert-paket");
let isPopupFormVisible = false;

btnShowFormPegawai.addEventListener("click", function () {
  if (!isPopupFormVisible && overlayFormPegawai && formPegawai) {
    showPopupForm();
  }
});

overlayFormPegawai.addEventListener('click', hidePopupForm);

if (btnClose) {
  btnClose.addEventListener('click', hidePopupForm);
}

function showPopupForm() {
  overlayFormPegawai.style.opacity = "1";
  overlayFormPegawai.style.visibility = "visible";
  formPegawai.style.top = "50%";
  formPegawai.style.opacity = "1";
  formPegawai.style.visibility = "visible";
  isPopupFormVisible = true;
}

function hidePopupForm() {
  if (overlayFormPegawai && formPegawai) {
    overlayFormPegawai.style.opacity = '0';
    overlayFormPegawai.style.visibility = 'hidden';
    formPegawai.style.top = '-100%';
    formPegawai.style.opacity = '0';
    formPegawai.style.visibility = 'hidden';
    isPopupFormVisible = false;
  }
}
