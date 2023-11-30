// ? untuk melihat password agar terlihat
const eyeIcon = document.getElementById("clickPassword");
const inputPassword = document.getElementById("password");
eyeIcon.addEventListener("click", () => {
  if (inputPassword.type === "password") {
    inputPassword.type = "text";
    eyeIcon.src = "svg/eye-line.svg";
  } else {
    inputPassword.type = "password";
    eyeIcon.src = "svg/eye-off-line.svg";
  }
});
