<!DOCTYPE html>
<html lang="pl-PL">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="./assets/img/ikona-strony.png" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #292b2c;
      color: #ffffff;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }

    .error-message {
      max-width: 600px;
      padding: 30px;
      background-color: #343a40;
      border-radius: 12px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .error-message p {
      font-weight: bold;
      font-size: x-large;
    }
  </style>
  <title>Forum | Informacja</title>
</head>

<body>
  <?php
  $error_messages = [
    'account-delete' => 'Konto zostało usunięte',
    'change-failed' => 'Nieudało się zresetować hasła',
    'change-success' => 'Hasło zostało zresetowane',
    'comment-added' => 'Komentarz został dodany',
    'comment-deleted' => 'Komentarz został usunięty',
    'comment-error' => 'Komentarz nie został dodany',
    'comment-not-found' => 'Nie znaleziono takiego komentarza',
    'delete-error' => 'Błąd podczas usuwania komentarza',
    'delete-error-post' => 'Błąd podczas usuwania postu',
    'invalid-request' => 'Nieprawidłowe zapytanie',
    'invalid-user-id' => 'Taki użytkownik nie istnieje!',
    'post-added' => 'Post został utworzony',
    'post-deleted' => 'Post został usunięty',
    'post-error' => 'Błąd podczas tworzenia posta',
    'post-not-found' => 'Nie znaleziono takiego posta',
  ];

  if (isset($_GET['info']) && isset($error_messages[$_GET['info']])) {
    echo '
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="error-message text-center">
            <p class="mb-4">' . $error_messages[$_GET['info']] . '</p>
            <a href="index.php" class="btn btn-warning btn-lg">Strona Główna</a>
          </div>
        </div>
      </div>
    </div>';
  }
  ?>
</body>

</html>
