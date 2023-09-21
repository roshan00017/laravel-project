function previewFile(input) {

  const file = input.files[0];

  const imagePreview = document.getElementById('imagePreview');
  const pdfName = document.getElementById('pdfName');
  const size = parseFloat(file.size / (1024 * 1024)).toFixed(2);

  if (file && size < 1) {
      if (file.type.includes('image')) {
          const reader = new FileReader();
          reader.onload = function (e) {
              imagePreview.src = e.target.result;
              imagePreview.style.display = 'block';
              pdfName.style.display = 'none';
          };
          reader.readAsDataURL(file);
      } else if (file.type === 'application/pdf') {
          imagePreview.style.display = 'none';
          pdfName.innerText = file.name;
          pdfName.style.display = 'block';
      } else {
          imagePreview.style.display = 'none';
          pdfName.style.display = 'none';
      }
  }
}
