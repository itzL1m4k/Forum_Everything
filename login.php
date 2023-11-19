<!DOCTYPE html>
<html lang="pl-PL">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="./assets/img/ikona-strony.png" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Forum | Zaloguj się</title>
  <style>
    body {
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #343a40;
      /* Kolor tła */
      color: white;
      /* Kolor tekstu */
    }

    .custom-form {
      max-width: 400px;
      margin: auto;
      background-color: #495057;
      /* Kolor tła formularza */
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      /* Cień formularza */
    }

    .login-form-footer {
      margin-top: 10px;
    }
  </style>
</head>

<body>

  <div class="container">

    <section class="login-section">

      <header class="login-header text-center">
        <h1>Strona Logowania</h1>
        <p>Proszę zaloguj się, aby korzystać ze strony</p>
      </header>

      <form class="login-form custom-form" action="./php/login-user.php" method="POST">

        <div class="login-form-content">

          <div class="mb-3">
            <label for="email" class="form-label">Podaj Email</label>
            <input type="text" class="form-control" id="email" name="email" />
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Podaj Hasło</label>
            <div class="input-group">
              <input type="password" class="form-control" id="password" name="password" />
              <button type="button" class="btn btn-outline-light" onclick="togglePasswordVisibility('password')"><i class="fa fa-eye-slash"></i></button>
            </div>
          </div>

          <div class="mb-3 form-check d-flex justify-content-between align-items-center">
            <div>
              <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe" />
              <label class="form-check-label" for="rememberMe">Zapamiętaj mnie</label>
            </div>
            <a href="reset.php">Nie pamiętam hasła</a>
          </div>

          <button id="login-in-button" type="submit" class="btn btn-primary">Zaloguj Się</button>

        </div>

        <?php
        $messages = [
          'login-failed' => 'Logowanie nie powiodło się. Spróbuj ponownie',
          'change-success' => 'Hasło zostało zmienione. Proszę się zalogować',
          'invalid-email' => 'E-mail nie jest poprawny'
        ];
        if (isset($_GET['error']) || isset($_GET['success'])) {
          $message_key = $_GET['error'] ?? $_GET['success'];
          echo array_key_exists($message_key, $messages) ? '<div class="error-message">' . $messages[$message_key] . '</div>' : '';
        }
        ?>

        <footer class="login-form-footer text-center">
          <p>Nie masz konta? <a href="./register.php"> Zarejestruj Się</a></p>
        </footer>

      </form>

    </section>

  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="./js/pass-validation.js"></script>

</body>

</html>
