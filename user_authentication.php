<!DOCTYPE html>
<html lang="pl-PL">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="shortcut icon" href="assets/img/page_icon.png" type="image/x-icon" />
  <link rel="stylesheet" href="css/authentication_styles.css">
  <title>Forum | Zaloguj/Zarejestruj się</title>
</head>

<body>

  <div class="container" id="container">
    <div class="form-container sign-up">
      <form action="php/user_registration.php" method="POST">
        <h1>Stwórz konto</h1>
        <span>Użyj swojego maila do rejestracji</span>
        <input type="text" id="nickname" name="nickname" value="<?= htmlspecialchars($_GET['nickname'] ?? '') ?>" placeholder="Nazwa" autocomplete="username" required>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($_GET['email'] ?? '') ?>" placeholder="Email" autocomplete="email" required>
        <div class="password-container">
          <input type="password" id="password1" name="password" placeholder="Hasło" required>
          <span class="password-toggle-button" onclick="togglePasswordFieldVisibility('password1')">
            <i class="fa fa-eye-slash"></i>
          </span>
        </div>
        <div class="checkbox-container">
          <input type="checkbox" id="privacyPolicy" name="privacyPolicy" />
          <label for="privacyPolicy" class="checkboxLabel"> Zatwierdzam
            <a href="privacy_policy.html" target="_blank" rel="noopener">politykę</a>
          </label>
        </div>
        <button id="register-button" type="submit">Zarejestruj się</button>
      </form>
    </div>

    <div class="form-container sign-in">
      <form action="php/user_login.php" method="POST">
        <h1>Zaloguj się</h1>
        <span>Użyj swojego hasła z maila</span>
        <input type="email" name="email" placeholder="Email" autocomplete="email" required>
        <div class="password-container">
          <input type="password" id="password2" name="password" placeholder="Hasło" required>
          <span class="password-toggle-button" onclick="togglePasswordFieldVisibility('password2')">
            <i class="fa fa-eye-slash"></i>
          </span>
        </div>
        <a href="password_reset.php">Zapomniałeś hasła?</a>
        <button id="login-in-button" type="submit">Zaloguj się</button>
      </form>
    </div>

    <div class="toggle-container">
      <div class="toggle">
        <div class="toggle-panel toggle-left">
          <h1>Witamy Ponownie!</h1>
          <p>Wprowadź swoje dane osobowe, aby korzystać ze wszystkich funkcji witryny</p>
          <button class="hidden" id="login">Zaloguj się</button>
        </div>
        <div class="toggle-panel toggle-right">
          <h1>Witaj Przyjacielu!</h1>
          <p>Zarejestruj się, podając swoje dane osobowe, aby korzystać ze wszystkich funkcji witryny</p>
          <button class="hidden" id="register">Zarejestruj się</button>
        </div>
      </div>
    </div>
  </div>

  <script src="js/jquery-3.7.1.min.js"></script>
  <script src="js/sweetalert2.all.min.js"></script>
  <script src="js/password_validation.js"></script>
  <script src="js/authentication.js"></script>
  <?php
  $messages = [
    'login_failed' => 'Logowanie nie powiodło się',
    'register_failed' => 'Rejestracja nie powiodła się!',
    'change_success' => 'Hasło zostało zmienione',
    'user_exists' => 'Taki sam e-mail lub nick już istnieją!',
    'accept_policy' => 'Zatwierdź zasady polityki prywatności',
    'account_create' => "Pomyślnie utworzono konto",
    'change_success' => "Zmieniono hasło"
  ];
  if (isset($_GET['error']) || isset($_GET['success'])) {
    $message_key = $_GET['error'] ?? $_GET['success'];
    $message = array_key_exists($message_key, $messages) ? $messages[$message_key] : '';
    $isSuccess = isset($messages[$message_key]) && isset($_GET['success']);

    echo '<script>';
    echo 'Swal.fire({
            icon: "' . ($isSuccess ? "
            success " : "
            error ") . '",
              title: "' . $message . '",
              showConfirmButton: false,
              timer: 2000,
              toast: true,
              position: "top",
              customClass: {
                popup: "my-custom-popup-class",
                title: "my-custom-title-class",
                content: "my-custom-content-class",
              }
          });
          ';
    echo '</script>';
  } ?>

</body>

</html>
