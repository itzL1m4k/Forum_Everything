function togglePasswordFieldVisibility(id) {
  let $field = $("#" + id);
  let $toggleButton = $field.next();

  $field.attr("type", $field.attr("type") === "password" ? "text" : "password");
  $toggleButton.html(
    $field.attr("type") === "password"
      ? '<i class="fa fa-eye-slash"></i>'
      : '<i class="fa fa-eye"></i>'
  );
}
function validatePassword(passwordId, pattern, errorMsg) {
  let password = $("#" + passwordId).val();

  if (!pattern.test(password) && !errorMsg) {
    errorMsg =
      "Hasło nie spełnia wymagań:\n" +
      "- 8 znaków\n" +
      "- Jedna cyfra\n" +
      "- Jedna mała litera\n" +
      "- Jedna duża litera\n" +
      "- Jeden znak specjalny";
  }

  return errorMsg;
}

function validate1(passwordId, emailId, nicknameId, privacyPolicyId) {
  let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+/;
  let errorMsg;

  errorMsg = validatePassword(
    "password1",
    /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.{8,})/,
    errorMsg
  );

  if (!$("#" + privacyPolicyId).prop("checked")) {
    errorMsg = "Zatwierdź politykę prywatności!";
  }

  if (!emailRegex.test($("#" + emailId).val())) {
    errorMsg = "Adres e-mail jest niepoprawny!";
  }

  if (!($("#" + nicknameId).val().length >= 3)) {
    errorMsg = "Nazwa użytkownika musi być dłuższa!";
  }

  if (errorMsg) {
    showErrorMessage(errorMsg);
    return false;
  }

  return true;
}

function validate2(passwordId) {
  let errorMsg = validatePassword(
    passwordId,
    /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.{8,})/
  );

  if (errorMsg) {
    showErrorMessage(errorMsg);
    return false;
  }

  return true;
}

function showErrorMessage(errorMsg) {
  Swal.fire({
    icon: "error",
    title: errorMsg,
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

$("#register-button").on("click", function (event) {
  if (!validate1("password1", "email", "nickname", "privacyPolicy")) {
    event.preventDefault();
  }
});

$("#change-password").on("click", function (event) {
  if (!validate2("password")) {
    event.preventDefault();
  }
});
