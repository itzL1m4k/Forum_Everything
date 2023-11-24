<!DOCTYPE html>
<html lang="pl-PL">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link rel="shortcut icon" href="assets/img/page_icon.png" type="image/x-icon" />
  <link rel="stylesheet" href="css/authentication_styles.css" />
  <title>Forum | Zarejestruj się</title>
</head>

<body>
  <div class="container">
    <section class="login-section">
      <header class="login-header">
        <h1>Strona Rejestracji</h1>
        <p>Proszę Zarejestruj się, aby korzystać ze strony</p>
      </header>
      <form class="login-form" action="php/user_registration.php" method="POST" onsubmit="return validatePassword();">
        <div class="login-form-content">
          <div class="form-item">
            <label for="email">Podaj Email</label>
            <input type="text" id="email" name="email" value="<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>" required />
          </div>
          <div class="form-item">
            <label for="nickname">Podaj Nickname</label>
            <input type="text" id="nickname" name="nickname" value="<?php echo isset($_GET['nickname']) ? $_GET['nickname'] : ''; ?>" required />
          </div>
          <div class="form-item">
            <div class="password-container">
              <label for="password">Podaj Hasło</label>
              <input class="password-input" type="password" id="password" name="password" required />
              <button type="button" class="password-toggle-button" onclick="togglePasswordVisibility('password')"><i class="fa fa-eye-slash"></i></button>
            </div>
          </div>
          <div class="form-item">
            <div class="password-container">
              <label for="again-password">Powtórz Hasło</label>
              <input class="password-input" type="password" id="again-password" name="again-password" required />
              <button type="button" class="password-toggle-button" onclick="togglePasswordVisibility('again-password')"><i class="fa fa-eye-slash"></i></button>
            </div>
          </div>
          <div class="form-item">
            <div class="checkbox">
              <input type="checkbox" id="privacyPolicy" name="privacyPolicy" />
              <label for="privacyPolicy" class="checkboxLabel">Zatwierdzam <a href="privacy_policy.html" target="_blank"> politykę prywatności</a></label>
            </div>
          </div>
          <button id="register-button" type="submit">Zarejestruj Się</button>
        </div>
        <?php
        $error_messages = [
          'user_exists' => 'Taki sam e-mail lub nick już istnieją!',
          'register_failed' => 'Rejestracja nie powiodła się!',
          'invalid_email' => 'Adres e-mail jest niepoprawny!',
          'accept_policy' => 'Zatwierdź zasady polityki prywatności'
        ];
        if (isset($_GET['error']) && array_key_exists($_GET['error'], $error_messages)) {
          echo '<div class="error-message">' . $error_messages[$_GET['error']] . '</div>';
        }
        ?>
        <div class="login-form-footer">
          <p>Masz już konto? <a href="user_login.php"> Zaloguj Się</a></p>
        </div>
      </form>
    </section>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="js/password_validation.js"></script>
</body>

</html>
