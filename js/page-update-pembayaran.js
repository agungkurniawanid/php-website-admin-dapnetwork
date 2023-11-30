function changeImageHalamanUpdatePembayaran(input) {
    const fileInput = input.files[0];
    if (fileInput) {
      const reader = new FileReader();
  
      reader.onload = function (e) {
        const imageElement = document.getElementById("img");
        imageElement.src = e.target.result;
      };
  
      reader.readAsDataURL(fileInput);
    }
  }