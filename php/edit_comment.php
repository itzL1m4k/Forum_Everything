<?php
require_once("database_connection.php");

if (isset($_GET['id']) && isset($_POST['tresc'])) {
  $postId = mysqli_real_escape_string($conn, $_GET['id']);
  $tresc = mysqli_real_escape_string($conn, $_POST['tresc']);

  $updateSql = "UPDATE komentarze SET tresc = ? WHERE id = ?";
  $stmt = mysqli_prepare($conn, $updateSql);
  mysqli_stmt_bind_param($stmt, "si", $tresc, $postId);

  if (mysqli_stmt_execute($stmt) && mysqli_stmt_affected_rows($stmt) > 0) {
    header("Location: ../index.php");
    exit;
  } else {
    header("Location: ../notification.php?error=edit_comment");
    exit;
  }

  mysqli_stmt_close($stmt);
} else {
  if (isset($_GET['id'])) {
    $postId = mysqli_real_escape_string($conn, $_GET['id']);

    $selectSql = "SELECT * FROM komentarze WHERE id = ?";
    $stmtSelect = mysqli_prepare($conn, $selectSql);
    mysqli_stmt_bind_param($stmtSelect, "i", $postId);
    mysqli_stmt_execute($stmtSelect);

    $result = mysqli_stmt_get_result($stmtSelect);

    if ($result && mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $tresc = htmlspecialchars($row['tresc']);
?>

      <!DOCTYPE html>
      <html lang="pl-PL">

      <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../assets/img/favicon.png" type="image/x-icon">
        <link rel="stylesheet" href="../css/content_edit_styles.css">
        <title>Forum | Edytuj komentarz</title>
      </head>

      <body>
        <h1>Edytuj komentarz</h1>
        <form method="POST" action="">
          <textarea name="tresc"><?= $tresc; ?></textarea>
          <div class="buttons">
            <input type="submit" value="Zapisz zmiany">
          </div>
        </form>
      </body>

      </html>

<?php
    } else {
      header("Location: ../notification.php?error=invalid_request_comment");
      exit;
    }

    mysqli_stmt_close($stmtSelect);
  } else {
    header("Location: ../notification.php?error=invalid_request_comment");
    exit;
  }
}

mysqli_close($conn);
?>
