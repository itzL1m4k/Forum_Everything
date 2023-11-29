<?php
require_once("database_connection.php");

$nickname = $_POST['settings-nick'] ?? '';
$email = $_POST['settings-email'] ?? '';

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  redirectToProfileWithError('invalid_email');
}

session_start();
$id = $_SESSION['user_id'] ?? '';

if (empty($id)) {
  redirectToProfileWithError('invalid_user');
}

$stmt = mysqli_prepare($conn, "UPDATE uzytkownicy SET nickname = ?, email = ? WHERE user_id = ?");
mysqli_stmt_bind_param($stmt, "ssi", $nickname, $email, $id);

if (mysqli_stmt_execute($stmt)) {
  redirectToProfileWithSuccess('change_success');
} else {
  redirectToProfileWithError('change_failed');
}

function redirectToProfileWithError($error)
{
  header("Location: ../user_profile.php?error=$error");
  exit;
}
function redirectToProfileWithSuccess($success)
{
  header("Location: ../user_profile.php?error=$success");
  exit;
}
