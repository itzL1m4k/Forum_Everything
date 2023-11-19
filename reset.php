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
  <title>Forum | Zresetuj hasło</title>
</head>

<body>

  <div class="container">

    <section class="login-section">

      <header class="login-header text-center">
        <h1>Zmiana hasła</h1>
      </header>

      <form class="login-form custom-form" action="./php/reset-pass.php" method="POST" onsubmit="return validatePassword();">

        <div class="login-form-content">

          <div class="mb-3">
            <label for="email" class="form-label">Podaj Email</label>
            <input type="text" class="form-control" id="email" name="email" required />
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Podaj Nowe Hasło</label>
            <div class="input-group">
              <input type="password" class="form-control" id="password" name="password" />
              <button type="button" class="btn btn-outline-light" onclick="togglePasswordVisibility('password')"><i class="fa fa-eye-slash"></i></button>
            </div>
          </div>

          <div class="mb-3">
            <label for="again-password" class="form-label">Powtórz Nowe Hasło</label>
            <div class="input-group">
              <input type="password" class="form-control" id="again-password" name="again-password" />
              <button type="button" class="btn btn-outline-light" onclick="togglePasswordVisibility('again-password')"><i class="fa fa-eye-slash"></i></button>
            </div>
          </div>

          <button id="login-in-button" type="submit" class="btn btn-primary">Zmień Hasło</button>

        </div>

        <?php
        $errors = [
          'change-failed' => 'Zmiana hasła niepowiodła się',
          'invalid-email' => 'Nie ma użytkownika z tym adresem e-mail'
        ];
        $error = $_GET['error'] ?? '';
        if (array_key_exists($error, $errors)) {
          echo '<div class="error-message">' . $errors[$error] . '</div>';
        }
        ?>

        <div class="login-form-footer">
          <p>Nie posiadasz konta? <a href="register.php"> Zarejestruj Się</a></p>
        </div>

      </form>

    </section>

  </div>

  <!-- Skrypty -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="./js/pass-validation.js"></script>

</body>

</html>
