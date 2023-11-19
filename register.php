<!DOCTYPE html>
<html lang="pl-PL">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="./assets/img/ikona-strony.png" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #343a40;
      color: white;
    }

    .custom-form {
      max-width: 400px;
      margin: auto;
      background-color: #495057;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .login-form-footer {
      margin-top: 10px;
    }

    .password-container {
      position: relative;
    }

    .password-toggle-button {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      background-color: transparent;
      border: none;
      cursor: pointer;
    }
  </style>
  <title>Forum | Zarejestruj się</title>
</head>

<body>

  <div class="container">

    <section class="login-section">

      <header class="login-header text-center">
        <h1>Strona Rejestracji</h1>
        <p>Proszę Zarejestruj się, aby korzystać ze strony</p>
      </header>

      <form class="login-form custom-form" action="./php/register-user.php" method="POST" onsubmit="return validatePassword();">

        <div class="login-form-content">

          <div class="mb-3">
            <label for="email" class="form-label">Podaj Email</label>
            <input type="text" class="form-control" id="email" name="email" value="<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>" required />
          </div>

          <div class="mb-3">
            <label for="nickname" class="form-label">Podaj Nickname</label>
            <input type="text" class="form-control" id="nickname" name="nickname" value="<?php echo isset($_GET['nickname']) ? $_GET['nickname'] : ''; ?>" required />
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Podaj Hasło</label>
            <div class="input-group">
              <input type="password" class="form-control" id="password" name="password" />
              <button type="button" class="btn btn-outline-light" onclick="togglePasswordVisibility('password')"><i class="fa fa-eye-slash"></i></button>
            </div>
          </div>

          <div class="mb-3">
            <label for="again-password" class="form-label">Podaj Hasło</label>
            <div class="input-group">
              <input type="password" class="form-control" id="again-password" name="again-password" />
              <button type="button" class="btn btn-outline-light" onclick="togglePasswordVisibility('again-password')"><i class="fa fa-eye-slash"></i></button>
            </div>
          </div>

          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="privacyPolicy" name="privacyPolicy" />
            <label class="form-check-label checkboxLabel" for="privacyPolicy">Zatwierdzam <a href="privacy.html" target="_blank"> politykę prywatności</a></label>
          </div>

          <button id="register-button" type="submit" class="btn btn-primary">Zarejestruj Się</button>

        </div>

        <?php
        $error_messages = [
          'user-exists' => 'Taki sam e-mail lub nick już istnieją!',
          'register-failed' => 'Rejestracja nie powiodła się!',
          'invalid-email' => 'Adres e-mail jest niepoprawny!',
          'accept-policy' => 'Zatwierdź zasady polityki prywatności'
        ];
        if (isset($_GET['error']) && array_key_exists($_GET['error'], $error_messages)) {
          echo '<div class="error-message">' . $error_messages[$_GET['error']] . '</div>';
        }
        ?>

        <div class="login-form-footer">
          <p>Masz już konto? <a href="login.php"> Zaloguj Się</a></p>
        </div>

      </form>

    </section>

  </div>

  <!-- Skrypty -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.all.min.js"></script>
  <script src="./js/pass-validation.js"></script>

</body>

</html>
