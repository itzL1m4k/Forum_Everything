<?php
if (isset($_POST['log-out'])) {
  session_start();
  session_unset();
  session_destroy();
  setcookie('login_cookie', '', time() - 3600 * 7, '/');
  header("Location: index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="pl-PL">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon" />
  <link rel="stylesheet" href="css/global_styles.css" />
  <link rel="stylesheet" href="css/profile_data_styles.css" />
  <title>Forum | Twoje Konto</title>
</head>

<body>
  <button id="to-top-btn" onclick="scrollToTop()">
    <img id="arrow-up" src="assets/img/arrow_up.svg" alt="strzałka do góry" />
  </button>
  <div class="container">
    <div class="logo">
      <h1><a href="index.php">Forum Everything</a></h1>
    </div>
    <header class="d-flex mt-3">
      <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item"><a href="index.php" class="nav-link">Wpisy</a></li>
              <li class="nav-item"><a href="https://github.com/itzL1m4k/Forum_Everything" target="_blank" rel="noopener" class="nav-link">Dokumentacja</a></li>
              <li class="nav-item"><a href="about_code_2.html" class="nav-link">Kod JavaScript</a></li>
            </ul>
            <ul class="navbar-nav">
              <li class="nav-item login-nav"><a href="user_authentication.php?config=login" class="nav-link">Zaloguj się</a></li>
              <li class="nav-item login-nav"><a href="user_authentication.php?config=register" class="nav-link">Zarejestruj się</a></li>
              <li class="nav-item yourAccount hidden"><a href="user_profile.php" class="nav-link">Twoje konto</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <main>
      <section class="user-profile">
        <nav id="user-settings-nav">
          <ul>
            <li><button id="user-button">Informacje</button></li><br>
            <li><button id="privacy-button">Hasło</button></li><br>
            <li>
              <form method="POST">
                <button id="log-out-button" name="log-out">Wyloguj się</button>
              </form>
            </li>
          </ul>
        </nav>
        <section class="settings">
          <div class="settings__user">
            <h2>Dane Użytkownika</h2>
            <form action="php/save_data.php" method="POST">
              <?php
              require_once("php/database_connection.php");

              session_start();
              $user_id = $_SESSION['user_id'] ?? null;

              $sql = "SELECT email, nickname, data_publikacji FROM uzytkownicy WHERE user_id = ?";
              $stmt = mysqli_prepare($conn, $sql);
              mysqli_stmt_bind_param($stmt, "i", $user_id);
              mysqli_stmt_execute($stmt);

              $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
              ?>
              <div class="form-item">
                <label for="settings-email">Twój E-mail</label>
                <input type="text" id="settings-email" name="settings-email" value="<?= htmlspecialchars($row['email']) ?>" readonly>
              </div>
              <div class="form-item">
                <label for="settings-nick">Twój Nickname</label>
                <input type="text" id="settings-nick" name="settings-nick" value="<?= htmlspecialchars($row['nickname']) ?>" readonly>
              </div>
              <div class="form-item">
                <label for="settings-data">Założenia Konta</label>
                <input type="text" id="settings-data" name="settings-data" value="<?= htmlspecialchars($row['data_publikacji']) ?>" readonly>
              </div>
              <div class="buttons-form">
                <div class="change-user-data">
                  <button type="button" id="change-data">Uaktualnij Dane</button>
                </div>
                <div class="save-changes">
                  <button type="submit">Zapisz Zmiany</button>
                </div>
                <div class="delete-account">
                  <button type="button" onclick="deleteAccount()">Usuń Konto</button>
                </div>
              </div>
              <div class="message hidden">
                Możesz teraz edytować swoje dane
              </div>
            </form>
          </div>
          <div class="settings__privacy hidden">
            <h2>Zapomniałeś swojego hasła? Chcesz je zmienić?</h2>
            <p>Wystarczy, że napiszesz jakie chcesz mieć nowe hasło!</p>
            <form action="php/password_reset.php" method="POST">
              <div class="login-form-content">
                <div class="form-item">
                  <div class="password-container">
                    <label for="password">Podaj Nowe Hasło</label>
                    <input class="password-input" type="password" id="password" name="password" />
                    <button type="button" class="password-toggle-button" onclick="togglePasswordFieldVisibility('password')"> <i class="fa fa-eye-slash"></i>
                    </button>
                  </div>
                </div>
                <div class="form-item">
                  <div class="password-container">
                    <label for="again-password">Powtórz Nowe Hasło</label>
                    <input class="password-input" type="password" id="again-password" name="again-password" />
                    <button type="button" class="password-toggle-button" onclick="togglePasswordFieldVisibility('again-password')"><i class="fa fa-eye-slash"></i>
                    </button>
                  </div>
                </div>
                <div class="save-changes" id="save-pass">
                  <button type="submit" id="new-password">Zmień Hasło</button>
                </div>
              </div>
            </form>
          </div>
        </section>
      </section>
    </main>
    <footer>
      <p>&copy; Copyright by <span><a href="https://github.com/itzL1m4k"> Kamil Popiołek</a></span></p>
    </footer>
  </div>

  <script src="js/sweetalert2.all.min.js"></script>

  <?php
  $messages = [
    'invalid-email' => 'Adres e-mail jest niepoprawny!',
    'change_failed' => 'Nieudało się zapisać zmian',
    'change_success' => 'Zmiany zostały zapisane'
  ];
  if (isset($_GET['error']) || isset($_GET['success'])) {
    $message_key = $_GET['error'] ?? $_GET['success'];
    $message = array_key_exists($message_key, $messages) ? $messages[$message_key] : '';
    $isSuccess = isset($messages[$message_key]) && isset($_GET['success']);
    echo '<script>';
    echo 'Swal.fire({
                icon: "' . ($isSuccess ? "success" : "error") . '",
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
  }
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="js/jquery-3.7.1.min.js"></script>
  <script src="js/user_content_handler.js"></script>
  <script src="js/user_settings_toggle.js"></script>
  <script src="js/password_validation.js"></script>
  <script src="js/account_deletion.js"></script>
  <script src="js/smooth_scroll.js"></script>
  <script>
    $(document).ready(function() {
      $("#log-out-button").click(function() {
        localStorage.removeItem("cookies_accept")
      })
    })
  </script>
</body>

</html>
