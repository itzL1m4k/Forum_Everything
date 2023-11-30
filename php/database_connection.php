<?php
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_database = 'ITForum_L';

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_database);

if (!$conn) {
  die("Połączenie nieudane: " . mysqli_connect_error());
}
