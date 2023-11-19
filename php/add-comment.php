<?php
require_once("connect.php");

session_start();
$autor_id = $_SESSION['user_id'];
$wpis_id = $_POST['wpis_id'];
$tresc = $_POST['tresc'];

$query = "INSERT INTO komentarze (autor_id, wpis_id, tresc) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $query);

if ($stmt && mysqli_stmt_bind_param($stmt, "iis", $autor_id, $wpis_id, $tresc) && mysqli_stmt_execute($stmt)) {
  header('Location: ../notify.php?info=comment-added');
} else {
  header('Location: ../notify.php?info=comment-error');
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
exit;
