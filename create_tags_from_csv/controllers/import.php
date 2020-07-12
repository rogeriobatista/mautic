<?php
include "../config/constants.php";
include "../source/vendor/autoload.php";

session_start();

if (!$_SESSION['logged'])
    die();

$credentials = array(
    'userName' => MAUTIC_USER,
    'password' => MAUTIC_PASSWORD
);

$initAuth = new Mautic\Auth\ApiAuth();

try {
    $auth = $initAuth->newAuth($credentials, 'BasicAuth');
}
catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    die();
}

$api = new Mautic\MauticApi();

$filename = $_FILES["file"]["tmp_name"];
$separator = $_POST['separator'];
$source = $_POST['source'];

if (!isset($separator) || !isset($source))
    die();

if($_FILES["file"]["size"] > 0)
{
    $file = fopen($filename, "r");
    $index = 0;
    while (($getData = fgetcsv($file, 10000, $separator)) !== FALSE)
    {
        if ($index > 0) {
            switch($source) {
                case 'rd-station' : createTag($getData, 4, 0, ','); break;
                case 'klick-send' : createTag($getData, 4, 0, ';'); break;
            }
        }

        $index++;
    }
    
    fclose($file);
}

header('Location: /import.php');

function createTag($data, $tagIndex, $emailIndex, $array_separator) {
    global $api;
    global $auth;

    $tags = $data[$tagIndex];

    if ($tags == "")
        return;

    $tags_array = explode($array_separator, $tags);

    $contactApi = $api->newApi('contacts', $auth, MAUTIC_URL);
    $email = $data[$emailIndex];
    $contacts = $contactApi->getList("email:$email");

    foreach ($contacts['contacts'] as $contact) {
        $contactId = $contact['id'];
    }

    $data = [
        'ipAddress' => $_SERVER['REMOTE_ADDR'],
        'tags' => $tags_array,
        'overwriteWithBlank' => false,
    ];
    $createIfNotFound = false;
    $contact = $contactApi->edit($contactId, $data, $createIfNotFound);
}
