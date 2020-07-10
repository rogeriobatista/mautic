<?php
session_start();

if (!$_SESSION['logged'])
    die();

session_destroy();

header('Location: /index.php');