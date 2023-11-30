// ? untuk animasi card body dari card informasi
document.addEventListener("DOMContentLoaded", function () {
  const cards = document.querySelectorAll(".card-body");
  setTimeout(() => {
    cards.forEach((card, index) => {
      setTimeout(() => {
        card.style.opacity = "1";
        card.style.transform = "translateY(0)";
      }, index * 500);
    });
  }, 500);
});

// ? untuk animasi masuk card informasi
document.addEventListener("DOMContentLoaded", function () {
  const cardContent = document.querySelectorAll(".card-content1");
  setTimeout(() => {
    cardContent.forEach((card, index) => {
      setTimeout(() => {
        card.style.opacity = "1";
        card.style.transform = "translateY(0)";
      }, index * 500);
    });
  }, 500);
});

// ? untuk animasi masuk card union 2
document.addEventListener("DOMContentLoaded", function () {
  const cardUnion2 = document.querySelectorAll(".animation-card-union-dua");
  setTimeout(() => {
    cardUnion2.forEach((card, index) => {
      setTimeout(() => {
        card.style.opacity = "1";
        card.style.transform = "translateY(0)";
      }, index * 500);
    });
  }, 500);
});
