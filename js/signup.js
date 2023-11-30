// todo replace image
function changeImage(input) {
  const fileInput = input.files[0];
  if (fileInput) {
    const reader = new FileReader();

    reader.onload = function (e) {
      const imageElement = document.getElementById("uploaded-image");
      imageElement.src = e.target.result;
    };

    reader.readAsDataURL(fileInput);
  }
}

// todo membuat huruf input awal kapital
function capitalized(input) {
  let inputValue = input.value;
  let capitalizedValue =
    inputValue.charAt(0).toUpperCase() + inputValue.slice(1);
  input.value = capitalizedValue;
}
