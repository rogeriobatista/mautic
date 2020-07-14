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
$index = 0;

if($_FILES["file"]["size"] > 0)
{
    $file = fopen($filename, "r");
    while (($getData = fgetcsv($file, 10000, $separator)) !== FALSE)
    {
        if ($index > 0) {
            switch($source) {
                case 'rd-station' : writeStatus($getData[0]); createTag($getData, 4, 0, ','); break;
                case 'klick-send' : writeStatus($getData[0]); createTag($getData, 4, 0, ';'); break;
            }
        }

        $index++;
    }
    
    fclose($file);

    clearStatusFile();
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

function writeStatus($email) {
    $content = readStatusFile();

    if ($content) {
        array_push($content, $email);
    } else {
        $content = array($email);
    }
    file_put_contents('../status.json', json_encode($content));
}

function readStatusFile() {
    global $index;

    if ($index > 1)
        return json_decode(file_get_contents('../status.json'),TRUE);
}

function clearStatusFile() {
    file_put_contents('../status.json', json_encode([]));
}
