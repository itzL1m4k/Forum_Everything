<?php
require_once("connect.php");

if (isset($_GET['id']) && isset($_POST['tresc'])) {
  $postId = $_GET['id'];
  $tresc = $_POST['tresc'];

  $updateSql = "UPDATE komentarze SET tresc = ? WHERE id = ?";
  $stmt = mysqli_prepare($conn, $updateSql);
  mysqli_stmt_bind_param($stmt, "si", $tresc, $postId);

  if (mysqli_stmt_execute($stmt) && mysqli_stmt_affected_rows($stmt) > 0) {
    header("Location: ../index.php");
    exit();
  } else {
    echo "Wystąpił błąd podczas aktualizacji komentarza.";
  }

  mysqli_stmt_close($stmt);
} else {
  if (isset($_GET['id'])) {
    $postId = $_GET['id'];

    $selectSql = "SELECT * FROM komentarze WHERE id = ?";
    $stmtSelect = mysqli_prepare($conn, $selectSql);
    mysqli_stmt_bind_param($stmtSelect, "i", $postId);
    mysqli_stmt_execute($stmtSelect);

    $result = mysqli_stmt_get_result($stmtSelect);

    if ($result && mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $tresc = $row['tresc'];
?>

      <!DOCTYPE html>
      <html lang="pl-PL">

      <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/edit-content.css">
        <title>Forum | Edytuj komentarz</title>
      </head>

      <body>
        <h1>Edytuj komentarz</h1>
        <form method="POST" action="">
          <textarea name="tresc"><?= htmlspecialchars($tresc); ?></textarea>
          <div class="buttons">
            <input type="submit" value="Zapisz zmiany">
          </div>
        </form>
      </body>

      </html>

<?php
    } else {
      echo "Komentarz o podanym identyfikatorze nie istnieje.";
    }

    mysqli_stmt_close($stmtSelect);
  } else {
    echo "Nieprawidłowy identyfikator komentarza.";
  }
}

mysqli_close($conn);
?>
