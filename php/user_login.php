<?php
require_once("database_connection.php");

$email = $_POST['email'];
$password = $_POST['password'];
$rememberMe = $_POST['rememberMe'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  header("Location: ../user_login.php?error=invalid_email");
  exit;
}

$stmt = prepareAndExecute("SELECT * FROM uzytkownicy WHERE email = ?", "s", $email);
$row = mysqli_fetch_assoc($stmt);

if ($row && password_verify($password, $row['haslo'])) {
  session_start();
  $_SESSION['login'] = true;
  $_SESSION['user_id'] = $row['user_id'];
  $_SESSION['nickname'] = $row['nickname'];
  if ($rememberMe) {
    $token = bin2hex(random_bytes(16));
    setcookie('login_cookie', $token, time() + 3600 * 7, '/');
  }
  header("Location: ../index.php");
  exit;
} else {
  header("Location: ../user_login.php?error=login_failed");
  exit;
}

function prepareAndExecute($query, $type, ...$params)
{
  global $conn;
  $stmt = mysqli_prepare($conn, $query);
  if ($stmt) {
    mysqli_stmt_bind_param($stmt, $type, ...$params);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
  } else {
    header("Location: ../user_login.php?error=internal_error");
    exit;
  }
}
mysqli_close($conn);
