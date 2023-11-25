<?php
require_once("database_connection.php");

$nickname = $_POST['nickname'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'];
$policy = $_POST['privacyPolicy'];

if (userExists($conn, $email, $nickname)) {
  redirectToRegister('user_exists');
}

$hashedPass = password_hash($password, PASSWORD_DEFAULT);

if (insertUser($conn, $nickname, $email, $hashedPass)) {
  $password = $hashedPass = '';
  header('Location: ../user_authentication.php?success=account_create&config=login');
  exit;
}

redirectToRegister('register_failed');

function redirectToRegister($error)
{
  $queryParams = http_build_query([
    'error' => $error,
    'nickname' => htmlspecialchars($_POST['nickname']),
    'email' => htmlspecialchars($_POST['email'])
  ]);

  header("Location: ../user_authentication.php?$queryParams&config=register");
  exit;
}

function userExists($conn, $email, $nickname)
{
  $stmt = mysqli_prepare($conn, "SELECT * FROM uzytkownicy WHERE email = ? OR nickname = ?");
  mysqli_stmt_bind_param($stmt, "ss", $email, $nickname);
  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);

  return mysqli_num_rows($result) > 0;
}

function insertUser($conn, $nickname, $email, $hashedPass)
{
  $stmt = mysqli_prepare($conn, "INSERT INTO uzytkownicy (nickname, email, haslo) VALUES (?, ?, ?)");
  mysqli_stmt_bind_param($stmt, "sss", $nickname, $email, $hashedPass);

  return mysqli_stmt_execute($stmt);
}
