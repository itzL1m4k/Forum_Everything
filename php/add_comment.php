<?php
require_once("database_connection.php");
session_start();

$autor_id = intval($_SESSION['user_id']);
$wpis_id = intval($_POST['wpis_id']);
$tresc = mysqli_real_escape_string($conn, $_POST['tresc']);

$query = "INSERT INTO komentarze (autor_id, wpis_id, tresc) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $query);

if ($stmt && mysqli_stmt_bind_param($stmt, "iis", $autor_id, $wpis_id, $tresc) && mysqli_stmt_execute($stmt)) {
  header('Location: ../notification.php?success=comment_added');
  exit;
} else {
  header('Location: ../notification.php?error=comment_error');
  exit;
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
