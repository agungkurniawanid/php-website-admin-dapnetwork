const carousel = document.querySelector(".container-card"),
  firstImg = carousel.querySelectorAll(".wrapper-card-informasi")[0];
let nextBtn = document.querySelectorAll(".swipe");
let isDragStart = false,
  prevPageX,
  prevScrollLeft;
let firstImgWidth = firstImg.clientWidth + 5;

nextBtn.forEach((btn) => {
  btn.addEventListener("click", () => {
    carousel.scrollLeft +=
      btn.id === "swipeleft" ? -firstImgWidth : firstImgWidth;
  });
});

const dragStart = (e) => {
  isDragStart = true;
  prevPageX = e.pageX;
  prevScrollLeft = carousel.scrollLeft;
};

const dragging = (e) => {
  if (!isDragStart) return;
  e.preventDefault();
  let position = e.pageX - prevPageX;
  carousel.scrollLeft = prevScrollLeft - position;
};

const dragStop = () => {
  isDragStart = false;
};

carousel.addEventListener("mousedown", dragStart);
carousel.addEventListener("mousemove", dragging);
carousel.addEventListener("mouseup", dragStop);

document.addEventListener("DOMContentLoaded", function () {
  const cards = document.querySelectorAll(".transition");
  setTimeout(() => {
    cards.forEach((card, index) => {
      setTimeout(() => {
        card.style.opacity = "1";
        card.style.transform = "translateX(0)";
      }, index * 500);
    });
  }, 500);
});

const buttonActionClient = document.getElementById('tambah-client');
const closeButtonClient = document.getElementById('closeButtonClient');
let boolShowPopupFormClient = false;
let popupFormClient = document.querySelector('.wrapper-popup-halaman-client');

buttonActionClient.addEventListener('click', function() {
  if (!boolShowPopupFormClient) {
    const showOverlayClient = document.querySelector('.overlay-popup');
    if (showOverlayClient && popupFormClient) {
      showOverlayClient.style.opacity = '1';
      showOverlayClient.style.visibility = 'visible';
      popupFormClient.style.top = '50%';
      popupFormClient.style.opacity = '1';
      popupFormClient.style.visibility = 'visible';
      
      boolShowPopupFormClient = true;
      showOverlayClient.addEventListener('click', function() {
        hidePopupForm();
      });

      if (closeButtonClient) {
        closeButtonClient.addEventListener('click', function() {
          hidePopupForm();
        });
      }
    }
  }
});

function hidePopupForm() {
  const showOverlayClient = document.querySelector('.overlay-popup');
  if (showOverlayClient && popupFormClient) {
    showOverlayClient.style.opacity = '0';
    showOverlayClient.style.visibility = 'hidden';
    popupFormClient.style.top = '-100%';
    popupFormClient.style.opacity = '0';
    popupFormClient.style.visibility = 'hidden';
    boolShowPopupFormClient = false;
  }
}

function changeImageHalamanClient(input) {
  const fileInput = input.files[0];
  if (fileInput) {
    const reader = new FileReader();

    reader.onload = function (e) {
      const imageElement = document.getElementById("uploaded-image-halamanclient");
      imageElement.src = e.target.result;
    };

    reader.readAsDataURL(fileInput);
  }
}
