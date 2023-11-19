<?php
require_once("connect.php");

if (isset($_POST['post-title'], $_POST['post-content'])) {
  session_start();
  $user_id = $_SESSION['user_id'];

  $title = $_POST['post-title'];
  $content = $_POST['post-content'];

  $image_data = null;
  if (isset($_FILES['post-image']) && $_FILES['post-image']['error'] === UPLOAD_ERR_OK) {
    $image_data = mysqli_real_escape_string($conn, file_get_contents($_FILES['post-image']['tmp_name']));
  }

  $sql = "INSERT INTO wpisy (autor_id, tytul, tresc, obrazek) VALUES ('$user_id', '$title', '$content', '$image_data')";

  if (mysqli_query($conn, $sql)) {
    header('Location: ../notify.php?info=post-added');
    exit;
  } else {
    header('Location: ../notify.php?info=post-error');
    exit;
  }
}

mysqli_close($conn);
