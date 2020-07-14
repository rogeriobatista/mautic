<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

$content = json_decode(file_get_contents('../status.json'),TRUE);

echo json_encode(array('total' => count($content), 'email' => $content[count($content) - 1]));