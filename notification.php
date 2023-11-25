<!DOCTYPE html>
<html lang="pl-PL">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/notification_styles.css">
  <title>Forum | Notify</title>
</head>

<body>
  <?php
  $messages = [
    'invalid_user' => 'Taki użytkownik nie istnieje!',
    'change_failed' => 'Nieudało się zresetować hasła',
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

  if (isset($_GET['info'])) {
    $message_key = $_GET['info'];
    $message = array_key_exists($message_key, $messages) ? $messages[$message_key] : '';
    $isSuccess = isset($messages[$message_key]);

    if ($isSuccess) {
      echo "<script src='js/sweetalert2.all.min.js'></script>";
      echo '<script>';
      echo 'Swal.fire({
            icon: "info",
            title: "' . $message . '",
            position: "center",
            showConfirmButton: true,
            confirmButtonText: "STRONA GŁÓWNA",
            customClass: {
                popup: "my-custom-popup-class",
                title: "my-custom-title-class",
                content: "my-custom-content-class",
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "index.php";
            }
        });';
      echo '</script>';
    }
  }
  ?>
</body>

</html>
