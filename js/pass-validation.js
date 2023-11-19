const togglePasswordVisibility = (e) => {
  let $a = $("#" + e),
    $t = $a.next();
  $a.attr("type", $a.attr("type") === "password" ? "text" : "password");
  $t.html(
    $a.attr("type") === "password" ? '<i class="fa fa-eye-slash"></i>' : '<i class="fa fa-eye"></i>'
  );
};

const validatePassword = () => {
  let $e = $("#password").val(),
    $a = $("#again-password").val(),
    pattern = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.{8,})/,
    errorMsg;

  if ($e !== $a) {
    errorMsg = "Hasła nie są takie same!";
  } else if (!pattern.test($e)) {
    errorMsg =
      "Hasło nie spełnia wymagań:\n" +
      "- 8 znaków\n" +
      "- Jedna cyfra (0-9)\n" +
      "- Jedna mała litera (a-z)\n" +
      "- Jedna duża litera (A-Z)\n" +
      "- Jeden znak specjalny (!@#$%^&*)";
  }

  if (errorMsg) {
    Swal.fire({
      icon: "error",
      title: errorMsg,
      customClass: {
        popup: "my-custom-popup-class",
        title: "my-custom-title-class",
        content: "my-custom-content-class",
        confirmButton: "my-custom-button-class",
      },
    });
    event.preventDefault();
  }
};
