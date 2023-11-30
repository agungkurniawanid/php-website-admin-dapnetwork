// todo untuk overlay dan popup form pemasukan
const btnClose = document.getElementById("closeInsertPemasukan");
const btnShowFormPegawai = document.getElementById("btn-tambah-pemasukan");
const overlayFormPegawai = document.querySelector(".overlay-page-pemasukan");
const formPegawai = document.querySelector(".modal-page-pemasukan");
let isPopupFormVisible = false;

btnShowFormPegawai.addEventListener("click", function () {
  if (!isPopupFormVisible && overlayFormPegawai && formPegawai) {
    showPopupForm();
  }

  overlayFormPegawai.addEventListener('click', hidePopupForm);

  if (btnClose) {
    btnClose.addEventListener('click', hidePopupForm);
  }
});

function showPopupForm() {
  overlayFormPegawai.style.opacity = "1";
  overlayFormPegawai.style.visibility = "visible";
  formPegawai.style.top = "40%";
  formPegawai.style.opacity = "1";
  formPegawai.style.visibility = "visible";
  isPopupFormVisible = true;
}

function hidePopupForm() {
  if (overlayFormPegawai && formPegawai) {
    overlayFormPegawai.style.opacity = '0';
    overlayFormPegawai.style.visibility = 'hidden';
    formPegawai.style.top = '0%';
    formPegawai.style.opacity = '0';
    formPegawai.style.visibility = 'hidden';
    isPopupFormVisible = false;
  }
}