// ? untuk memanggil sidebar saat ukuran mobile
const iconBarmenu = document.getElementById("barmenu");
const iconClose = document.getElementById("close");
const navBar = document.getElementById("sub-wrapper-sidebar");
let isOpen = false;
iconBarmenu.addEventListener("click", () => {
  if (!isOpen) {
    navBar.style.left = "0%";
    navBar.style.opacity = "1";
    navBar.style.visibility = "visible";
    isOpen = true;
  }
});
iconClose.addEventListener("click", () => {
  navBar.style.opacity = "0";
  navBar.style.visibility = "hidden";
  navBar.style.left = "-100%";
  isOpen = false;
});
