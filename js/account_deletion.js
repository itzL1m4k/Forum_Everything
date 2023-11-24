let deleteAccount = () => {
  Swal.fire({
    title: "Czy na pewno chcesz usunąć konto?",
    icon: "question",
    showCancelButton: true,
    confirmButtonText: "Tak, usuń",
    cancelButtonText: "Anuluj",
    customClass: {
      popup: "my-custom-popup-class",
      title: "my-custom-title-class",
      content: "my-custom-content-class",
      confirmButton: "my-custom-button-class",
      cancelButton: "my-custom-button-class",
    },
  }).then((result) => {
    if (result.isConfirmed) {
      $.post("./php/delete_account.php", function (data, status) {
        if (status === "success") {
          window.location.href = "./notification.php?info=account_delete";
          localStorage.removeItem("cookies_accept");
        }
      });
    }
  });
};
