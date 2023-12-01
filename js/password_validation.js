function togglePasswordFieldVisibility(a) {
  let inputField = $("#" + a),
    icon = inputField.next();

  inputField.attr("type", inputField.attr("type") === "password" ? "text" : "password");
  icon.html(
    inputField.attr("type") === "password"
      ? '<i class="fa fa-eye-slash"></i>'
      : '<i class="fa fa-eye"></i>'
  );
}

function validatePassword(a, regex, errorMessage) {
  let password = $("#" + a).val();

  return (
    regex.test(password) ||
      errorMessage ||
      (errorMessage =
        "Hasło nie spełnia wymagań:\n- 8 znaków\n- Jedna cyfra\n- Jedna mała litera\n- Jedna duża litera\n- Jeden znak specjalny"),
    errorMessage
  );
}

function validate1(a, t, e, s) {
  let errorMessage;

  errorMessage = validatePassword(
    "password1",
    /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.{8,})/,
    errorMessage
  );

  $("#" + s).prop("checked") || (errorMessage = "Zatwierdź politykę prywatności!");
  /^[^\s@]+@[^\s@]+\.[^\s@]+/.test($("#" + t).val()) ||
    (errorMessage = "Adres e-mail jest niepoprawny!");
  $("#" + e).val().length >= 3 || (errorMessage = "Nazwa użytkownika musi być dłuższa!");

  return !errorMessage || (showErrorMessage(errorMessage), false);
}

function validate2(a) {
  let errorMessage = validatePassword(
    a,
    /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.{8,})/
  );

  return !errorMessage || (showErrorMessage(errorMessage), false);
}

function validate3(a) {
  let pass1 = $("#password").val(),
    pass2 = $("#again-password").val();

  let errorMessage;

  if (pass1 !== pass2) {
    errorMessage = "Hasła nie są takie same!";
  }

  if (!errorMessage) {
    errorMessage = validatePassword(
      a,
      /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.{8,})/
    );
  }

  return !errorMessage || (showErrorMessage(errorMessage), false);
}

function showErrorMessage(errorMessage) {
  Swal.fire({
    icon: "error",
    title: errorMessage,
    showConfirmButton: false,
    timer: 5000,
    toast: true,
    position: "top",
    customClass: {
      popup: "my-custom-popup-class",
      title: "my-custom-title-class",
      content: "my-custom-content-class",
    },
  });
}

$("#register-button").click(function (e) {
  validate1("password1", "email", "nickname", "privacyPolicy") || e.preventDefault();
});

$("#change-password").click(function (e) {
  validate2("password") || e.preventDefault();
});

$("#new-password").click(function (e) {
  validate3("password") || e.preventDefault();
});
