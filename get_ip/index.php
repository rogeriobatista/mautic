<?php
/* getip.php */
header("Access-Control-Allow-Origin: *");
header('Cache-Control: no-cache, must-revalidate');
header('Content-type: application/json');

if (!empty($_SERVER['HTTP_CLIENT_IP']))
{
  $ip=$_SERVER['HTTP_CLIENT_IP'];
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
{
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}
else
{
  $ip=$_SERVER['REMOTE_ADDR'];
}
print json_encode(array('ip' => $ip));
