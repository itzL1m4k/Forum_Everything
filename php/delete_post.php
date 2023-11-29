<?php
require_once("database_connection.php");

if (isset($_GET['id'])) {
  $post_id = $_GET['id'];

  $check_query = "SELECT * FROM wpisy WHERE id = ?";
  $stmt_check = mysqli_prepare($conn, $check_query);
  mysqli_stmt_bind_param($stmt_check, "i", $post_id);
  mysqli_stmt_execute($stmt_check);
  $check_result = mysqli_stmt_get_result($stmt_check);

  if (mysqli_num_rows($check_result) > 0) {
    $delete_comments_query = "DELETE FROM komentarze WHERE wpis_id = ?";
    $stmt_delete_comments = mysqli_prepare($conn, $delete_comments_query);
    mysqli_stmt_bind_param($stmt_delete_comments, "i", $post_id);

    if (mysqli_stmt_execute($stmt_delete_comments)) {
      $delete_query = "DELETE FROM wpisy WHERE id = ?";
      $stmt_delete_post = mysqli_prepare($conn, $delete_query);
      mysqli_stmt_bind_param($stmt_delete_post, "i", $post_id);

      if (mysqli_stmt_execute($stmt_delete_post)) {
        header('Location: ../notification.php?success=post_deleted');
        exit;
      } else {
        header('Location: ../notification.php?error=delete_error_post');
        exit;
      }

      mysqli_stmt_close($stmt_delete_post);
    } else {
      header('Location: ../notification.php?error=delete_error_comments');
      exit;
    }

    mysqli_stmt_close($stmt_delete_comments);
  } else {
    header('Location: ../notification.php?error=post_not_found');
    exit;
  }

  mysqli_stmt_close($stmt_check);
} else {
  header('Location: ../notification.php?error=invalid_request');
  exit;
}

mysqli_close($conn);
