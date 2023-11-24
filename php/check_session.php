<?php
session_start();

$response = ['login' => (isset($_SESSION['login']) && $_SESSION['login'])];

header('Content-Type: application/json');
echo json_encode($response);
