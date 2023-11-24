<!DOCTYPE html>
<html lang="pl-PL">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link rel="shortcut icon" href="assets/img/page_icon.png" type="image/x-icon" />
  <link rel="stylesheet" href="css/authentication_styles.css" />
  <title>Forum | Zaloguj się</title>
</head>

<body>
  <div class="container">
    <section class="login-section">
      <header class="login-header">
        <h1>Strona Logowania</h1>
        <p>Proszę zaloguj się, aby korzystać ze strony</p>
      </header>
      <form class="login-form" action="php/user_login.php" method="POST">
        <div class="login-form-content">
          <div class="form-item">
            <label for="email">Podaj Email</label>
            <input type="text" id="email" name="email" required />
          </div>
          <div class="form-item">
            <div class="password-container">
              <label for="password">Podaj Hasło</label>
              <input class="password-input" type="password" id="password" name="password" required />
              <button type="button" class="password-toggle-button" onclick="togglePasswordVisibility('password')"><i class="fa fa-eye-slash"></i></button>
            </div>
          </div>
          <div class="form-item-options">
            <div class="checkbox">
              <input type="checkbox" id="rememberMe" name="rememberMe" />
              <label for="rememberMe" class="checkboxLabel">Zapamiętaj mnie</label>
            </div>
            <div class="forgot">
              <a href="password_reset.php">Nie pamiętam hasła</a>
            </div>
          </div>
          <button id="login-in-button" type="submit">Zaloguj Się</button>
        </div>
        <?php
        $messages = [
          'login_failed' => 'Logowanie nie powiodło się. Spróbuj ponownie',
          'change_success' => 'Hasło zostało zmienione. Proszę się zalogować',
          'invalid_email' => 'E-mail nie jest poprawny'
        ];
        if (isset($_GET['error']) || isset($_GET['success'])) {
          $message_key = $_GET['error'] ?? $_GET['success'];
          echo array_key_exists($message_key, $messages) ? '<div class="error-message">' . $messages[$message_key] . '</div>' : '';
        }
        ?>
        <footer class="login-form-footer">
          <p>Nie masz konta? <a href="user_registration.php"> Zarejestruj Się</a></p>
        </footer>
      </form>
    </section>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="js/password_validation.js"></script>
</body>

</html>
