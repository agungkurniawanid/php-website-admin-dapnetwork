// todo untuk replace image form
function changeImageFormPegawai(input) {
  const fileInput = input.files[0];
  if (fileInput) {
    const reader = new FileReader();

    reader.onload = function (e) {
      const imageElement = document.getElementById("imageFormPegawai");
      imageElement.src = e.target.result;
    };

    reader.readAsDataURL(fileInput);
  }
}

// todo untuk overlay dan popup form pegawai
const btnClose = document.getElementById("btn-close-form-pegawai");
const btnShowFormPegawai = document.getElementById("tambah-client");
const overlayFormPegawai = document.getElementById("overlay-form-pegawai");
const formPegawai = document.querySelector(".wrapper-popup-insert-pegawai");
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
