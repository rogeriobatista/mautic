<?php

$ch = curl_init();
curl_setopt( $ch, CURLOPT_URL, 'https://api.webinarjam.com/everwebinar/webinars');
curl_setopt( $ch, CURLOPT_HEADER, 0 );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true ); 
curl_setopt( $ch, CURLOPT_POST, 1 );
curl_setopt( $ch, CURLOPT_POSTFIELDS, array('api_key' => '8f4b0942-90cf-4e64-839e-157fa4e9bfc5'));

$data = curl_exec($ch);
curl_close($ch);

print($data);