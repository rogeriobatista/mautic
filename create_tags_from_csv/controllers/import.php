<?php
session_start();

if (!$_SESSION['logged'])
    die();

$filename = $_FILES["file"]["tmp_name"];
$tagIndex = $_POST['tag-index'];
$separator = $_POST['separator'];

if($_FILES["file"]["size"] > 0)
{
    $file = fopen($filename, "r");
    while (($getData = fgetcsv($file, 10000, $separator)) !== FALSE)
    {
        $tags = $getData[$tagIndex];
        
    }
    
    fclose($file);
}