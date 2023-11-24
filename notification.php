<!DOCTYPE html>
<html lang="pl-PL">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="assets/img/page_icon.png" type="image/x-icon" />
  <link rel="stylesheet" href="css/notification_styles.css">
  <title>Forum | Informacja</title>
</head>

<body>
  <?php
  $error_messages = [
    'invalid_user' => 'Taki użytkownik nie istnieje!',
    'change_failed' => 'Nieudało się zresetować hasła',
    'change_success' => 'Hasło zostało zresetowane',
    'post_added' => 'Post został utworzony',
    'post_error' => 'Błąd podczas tworzenia posta',
    'comment_added' => 'Komentarz został dodany',
    'comment_error' => 'Komentarz nie został dodany',
    'comment_deleted' => 'Komentarz został usunięty',
    'delete_error' => 'Błąd podczas usuwania komentarza',
    'comment_not_found' => 'Nie znaleziono takiego komentarza',
    'invalid_request' => 'Nieprawidłowe zapytanie',
    'post_deleted' => 'Post został usunięty',
    'delete_error_post' => 'Błąd podczas usuwania postu',
    'post_not_found' => 'Nie znaleziono takiego posta',
    'account_delete' => 'Konto zostało usunięte'
  ];
  if (isset($_GET['info']) && isset($error_messages[$_GET['info']])) {
    echo '<div class="error-message">' . $error_messages[$_GET['info']] .
      '<br><br> <a href="index.php">Strona Główna</a> </div>';
  }
  ?>
</body>

</html>
