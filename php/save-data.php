<?php
require_once("connect.php");

$nickname = $_POST['settings-nick'] ?? '';
$email = $_POST['settings-email'] ?? '';

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  redirectToProfileWithError('invalid-email');
}

session_start();
$id = $_SESSION['user_id'] ?? '';

if (empty($id)) {
  redirectToProfileWithError('invalid-user-id');
}

$stmt = mysqli_prepare($conn, "UPDATE uzytkownicy SET nickname = ?, email = ? WHERE user_id = ?");
mysqli_stmt_bind_param($stmt, "ssi", $nickname, $email, $id);

if (mysqli_stmt_execute($stmt)) {
  redirectToProfileWithError('change-success');
} else {
  redirectToProfileWithError('change-failed');
}

function redirectToProfileWithError($error)
{
  header("Location: ../profile-data.php?error=$error");
  exit;
}
