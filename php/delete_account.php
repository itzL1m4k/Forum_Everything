<?php
require_once("database_connection.php");

session_start();
$userId = $_SESSION['user_id'];

// Usuń komentarze użytkownika
$sqlDeleteComments = "DELETE FROM komentarze WHERE autor_id = ?";
$stmtDeleteComments = mysqli_prepare($conn, $sqlDeleteComments);
mysqli_stmt_bind_param($stmtDeleteComments, "i", $userId);
mysqli_stmt_execute($stmtDeleteComments);
mysqli_stmt_close($stmtDeleteComments);

// Usuń wpisy użytkownika
$sqlDeletePosts = "DELETE FROM wpisy WHERE autor_id = ?";
$stmtDeletePosts = mysqli_prepare($conn, $sqlDeletePosts);
mysqli_stmt_bind_param($stmtDeletePosts, "i", $userId);
mysqli_stmt_execute($stmtDeletePosts);
mysqli_stmt_close($stmtDeletePosts);

// Na koniec usuń użytkownika
$sqlDeleteUser = "DELETE FROM uzytkownicy WHERE user_id = ?";
$stmtDeleteUser = mysqli_prepare($conn, $sqlDeleteUser);
mysqli_stmt_bind_param($stmtDeleteUser, "i", $userId);

if ($stmtDeleteUser && mysqli_stmt_execute($stmtDeleteUser)) {
  session_unset();
  session_destroy();
  setcookie('login_cookie', '', time() - 3600 * 7, '/');
} else {
  header("Location: ../notification.php?info=account-error");
}

mysqli_stmt_close($stmtDeleteUser);
mysqli_close($conn);
