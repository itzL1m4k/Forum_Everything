<!DOCTYPE html>
<html lang="pl-PL">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link rel="shortcut icon" href="assets/img/page_icon.png" type="image/x-icon" />
  <link rel="stylesheet" href="css/authentication_styles.css" />
  <title>Forum | Zresetuj hasło</title>
</head>

<body>
  <div class="container">
    <section class="login-section">
      <header class="login-header">
        <h1>Zmiana hasła</h1>
      </header>
      <form class="login-form" action="php/password_reset.php" method="POST" onsubmit="return validatePassword();">
        <div class="login-form-content">
          <div class="form-item">
            <label for="email">Podaj Email</label>
            <input type="text" id="email" name="email" required />
          </div>
          <div class="form-item">
            <div class="password-container">
              <label for="password">Podaj Nowe Hasło</label>
              <input class="password-input" type="password" id="password" name="password" required />
              <button type="button" class="password-toggle-button" onclick="togglePasswordVisibility('password')"><i class="fa fa-eye-slash"></i></button>
            </div>
          </div>
          <div class="form-item">
            <div class="password-container">
              <label for="again-password">Powtórz Nowe Hasło</label>
              <input class="password-input" type="password" id="again-password" name="again-password" required />
              <button type="button" class="password-toggle-button" onclick="togglePasswordVisibility('again-password')"><i class="fa fa-eye-slash"></i></button>
            </div>
          </div>
          <button id="login-in-button" type="submit">Zmień Hasło</button>
        </div>
        <?php
        $errors = [
          'change_failed' => 'Zmiana hasła niepowiodła się',
          'invalid_email' => 'Nie ma użytkownika z tym adresem e-mail'
        ];
        $error = $_GET['error'] ?? '';
        if (array_key_exists($error, $errors)) {
          echo '<div class="error-message">' . $errors[$error] . '</div>';
        }
        ?>
        <div class="login-form-footer">
          <p>Nie posiadasz konta? <a href="php/user_registration.php"> Zarejestruj Się</a></p>
        </div>
      </form>
    </section>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="js/password_validation.js"></script>
</body>

</html>
