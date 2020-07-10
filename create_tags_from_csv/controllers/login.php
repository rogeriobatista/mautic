<?php
require_once('../config/constants.php');
session_start();

$login = $_POST['login'];
$password = $_POST['password'];

if ($login == DEFAULT_LOGIN && $password == DEFAULT_PASSWORD) {
    $_SESSION['logged'] = true;
    header('Location: /import.php');
} else {
    $_SESSION['error_message'] = 'Login or Password are incorrets!';
    header('Location: /index.php');
}