<?php
require_once("connect.php");

$email = $_POST['email'];
$password = $_POST['password'];
$rememberMe = $_POST['rememberMe'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  redirectWithError("invalid-email");
}

$stmt = prepareAndExecute("SELECT * FROM uzytkownicy WHERE email = ?", "s", $email);
$row = mysqli_fetch_assoc($stmt);

if ($row && password_verify($password, $row['haslo'])) {
  startSession();
  setSessionVariables($row);
  if ($rememberMe) {
    setRememberMeCookie();
  }
  redirect("../index.php");
} else {
  redirectWithError("login-failed");
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
    redirectWithError("internal-error");
  }
}

function redirect($location)
{
  header("Location: $location");
  exit;
}

function redirectWithError($error)
{
  redirect("../login.php?error=$error");
}

function startSession()
{
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  $_SESSION['login'] = true;
}

function setSessionVariables($row)
{
  $_SESSION['user_id'] = $row['user_id'];
  $_SESSION['nickname'] = $row['nickname'];
}

function setRememberMeCookie()
{
  $token = bin2hex(random_bytes(16));
  setcookie('login_cookie', $token, time() + 3600 * 7, '/');
}

mysqli_close($conn);
