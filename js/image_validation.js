function validateImageSize(t) {
  var files = t.files;

  for (var i = 0; i < files.length; i++) {
    var file = files[i];

    if (file.size > 3145728) {
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

      $(t).val("");
      return false;
    }
  }

  return true;
}
