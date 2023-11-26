<?php require_once("database_connection.php");

if (isset($_GET['id'])) {
  $comment_id = $_GET['id'];

  $check_query = "SELECT * FROM komentarze WHERE id = ?";
  $stmt_check = mysqli_prepare($conn, $check_query);
  mysqli_stmt_bind_param($stmt_check, "i", $comment_id);
  mysqli_stmt_execute($stmt_check);
  $check_result = mysqli_stmt_get_result($stmt_check);

  if (mysqli_num_rows($check_result) > 0) {
    $delete_query = "DELETE FROM komentarze WHERE id = ?";
    $stmt_delete = mysqli_prepare($conn, $delete_query);
    mysqli_stmt_bind_param($stmt_delete, "i", $comment_id);

    if (mysqli_stmt_execute($stmt_delete) && mysqli_stmt_affected_rows($stmt_delete) > 0) {
      header('Location: ../notification.php?success=comment_deleted');
    } else {
      header('Location: ../notification.php?error=delete_error');
    }

    mysqli_stmt_close($stmt_delete);
  } else {
    header('Location: ../notification.php?error=comment_not_found');
  }

  mysqli_stmt_close($stmt_check);
} else {
  header('Location: ../notification.php?error=invalid_request');
}

mysqli_close($conn);
