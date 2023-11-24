<?php
require_once("database_connection.php");

$email = $_POST['email'] ?? '';
$pass = $_POST['password'] ?? '';
$hashedPass = password_hash($pass, PASSWORD_DEFAULT);

session_start();
$user_id = $_SESSION['user_id'] ?? '';

if (empty($email) && !empty($user_id)) {
  handlePasswordChangeById($conn, $user_id, $hashedPass);
} elseif (!empty($email)) {
  handlePasswordChangeByEmail($conn, $email, $hashedPass);
} else {
  redirectToNotify('invalid_user');
}

function handlePasswordChangeById($conn, $user_id, $hashedPass)
{
  $result = mysqli_query($conn, "SELECT user_id FROM uzytkownicy WHERE user_id = '$user_id'");

  if (mysqli_num_rows($result) > 0) {
    $sql = "UPDATE uzytkownicy SET haslo = '$hashedPass' WHERE user_id = '$user_id'";
    executeQueryAndRedirect($conn, $sql, 'change_success', 'change_failed');
  } else {
    redirectToNotify('invalid_user');
  }
}

function handlePasswordChangeByEmail($conn, $email, $hashedPass)
{
  $result = mysqli_query($conn, "SELECT email FROM uzytkownicy WHERE email = '$email'");

  if (mysqli_num_rows($result) > 0) {
    $sql = "UPDATE uzytkownicy SET haslo = '$hashedPass' WHERE email = '$email'";
    executeQueryAndRedirect($conn, $sql, 'change_success', 'invalid-email');
  } else {
    redirectToReset('invalid_email');
  }
}

function executeQueryAndRedirect($conn, $sql, $successMessage, $failureMessage)
{
  if (mysqli_query($conn, $sql)) {
    redirectToNotify($successMessage);
  } else {
    redirectToReset($failureMessage);
  }
}

function redirectToNotify($info)
{
  header("Location: ../notification.php?info=$info");
  exit;
}

function redirectToReset($error)
{
  header("Location: ../password_reset.php?error=$error");
  exit;
}
