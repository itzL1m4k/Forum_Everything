function validateImageSize(fileInput) {
  var maxFileSize = 3 * 1024 * 1024;
  var files = fileInput.files;

  for (var i = 0; i < files.length; i++) {
    var file = files[i];
    if (file.size > maxFileSize) {
      Swal.fire({
        title: "Przepraszamy",
        text:
          "Rozmiar pliku " + file.name + " przekracza limit 3 megabajtów. Wybierz mniejszy plik.",
        icon: "error",
        confirmButtonText: "OK",
        customClass: {
          popup: "my-custom-popup-class",
          title: "my-custom-title-class",
          content: "my-custom-content-class",
          confirmButton: "my-custom-button-class",
        },
      });

      $(fileInput).val("");
      return false;
    }
  }
  return true;
}
