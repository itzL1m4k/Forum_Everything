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
  <div class="container" id="container">
    <div class="form-container sign-in">
      <form action="php/password_reset.php" method="POST">
        <h1>Zmień hasło</h1>
        <span>Zmień hasło dla swojego adresu email</span>
        <input type="email" name="email" placeholder="Email" autocomplete="email" required>
        <div class="password-container">
          <input type="password" id="password" name="password" placeholder="Nowe Hasło" required>
          <span class="password-toggle-button" onclick="togglePasswordFieldVisibility('password')">
            <i class="fa fa-eye-slash"></i>
          </span>
        </div>
        <button id="change-password" type="submit">Zmień hasło</button>
      </form>
    </div>

    <div class="toggle-container">
      <div class="toggle">
        <div class="toggle-panel toggle-right">
          <h1>Witaj Użytkowniku!</h1>
          <p>Tutaj możesz zmienić swoje hasło powiązane z twoim adresem e-mail</p>
          <p>Jeżeli jesteś tutaj przez przypadek, naciśnij przycisk poniżej</p>
          <button class="hidden" id="register" onclick="window.location.href='index.php'">Strona Główna</button>
        </div>
      </div>
    </div>
  </div>
  <script src="js/jquery-3.7.1.min.js"></script>
  <script src="js/sweetalert2.all.min.js"></script>
  <script src="js/password_validation.js"></script>

  <?php
  $messages = [
    'change_failed' => 'Nie udało się zmienić hasła',
    'invalid_email' => 'Taki adres email nie istnieje'
  ];

  if (isset($_GET['error'])) {
    $message_key = $_GET['error'];
    $message = array_key_exists($message_key, $messages) ? $messages[$message_key] : '';
    $isSuccess = isset($messages[$message_key]);

    echo '<script>';
    echo 'Swal.fire({
          icon: "error",
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
          });';
    echo '</script>';
  }
  ?>
</body>

</html>
