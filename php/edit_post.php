<?php
if (isset($_GET['id'])) {
  $postId = $_GET['id'];

  if (isset($_POST['tytul']) && isset($_POST['tresc'])) {
    $tytul = $_POST['tytul'];
    $tresc = $_POST['tresc'];

    require_once("database_connection.php");

    if (isset($_FILES['post-image']) && $_FILES['post-image']['error'] === UPLOAD_ERR_OK) {
      $obrazek_data = file_get_contents($_FILES['post-image']['tmp_name']);
      $obrazek_data = mysqli_real_escape_string($conn, $obrazek_data);

      $updateSql = "UPDATE wpisy SET tytul = '$tytul', tresc = '$tresc', obrazek = '$obrazek_data' WHERE id = $postId";
    } else {
      $updateSql = "UPDATE wpisy SET tytul = '$tytul', tresc = '$tresc' WHERE id = $postId";
    }

    $updateResult = mysqli_query($conn, $updateSql);

    if ($updateResult) {
      header("Location: ../index.php");
      exit();
    } else {
      header("Location ../notification.php?error=edit_post_error");
      exit;
    }
  }

  require_once("database_connection.php");

  $selectSql = "SELECT * FROM wpisy WHERE id = $postId";
  $result = mysqli_query($conn, $selectSql);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $tytul = $row['tytul'];
    $tresc = $row['tresc'];
?>

    <!DOCTYPE html>
    <html lang="pl-PL">

    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" href="../assets/img/page_icon.png" type="image/x-icon">
      <link rel="stylesheet" href="../css/content_edit_styles.css">
      <title>Forum | Edytuj post</title>
    </head>

    <body>
      <h1>Edytuj post</h1>
      <form method="POST" action="" enctype="multipart/form-data">
        <input type="text" name="tytul" value="<?php echo $tytul; ?>"><br><br>
        <textarea name="tresc"><?php echo $tresc; ?></textarea><br><br>
        <label for="image-input">Obrazek: &lt; 10Mb </label>
        <input type="file" name="post-image" accept="image/*" id="image-input" onchange="validateImageSize(this)"> <br>
        <div class="buttons">
          <input type="submit" value="Zapisz zmiany">
        </div>
      </form>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="../js/image_validation.js"></script>
    </body>

    </html>

<?php
  } else {
    header("Location ../notification.php?error=invalid_request_post");
    exit;
  }
  mysqli_close($conn);
} else {
  header("Location ../notification.php?error=invalid_request_post");
  exit;
}

?>
