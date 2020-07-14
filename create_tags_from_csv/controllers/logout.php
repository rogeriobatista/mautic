<?php
session_start();

if (!$_SESSION['logged'])
    die();

session_destroy();

header('Location: /tag-import/index.php');