<?php

include "webhook-to-mautic-api/credentials.php";

$token = $_POST['token'];
$returnto = $_POST['returnto'];
$url = $_POST['url'];
$prefix = $_POST['prefix'];
$email = $_POST['email'];

// if ($token != $credentials['securityToken'])
//     die();

// Init the CURL session
$ch = curl_init();
curl_setopt( $ch, CURLOPT_URL, $credentials['yourlsURL'] . '/yourls-api.php' );
curl_setopt( $ch, CURLOPT_HEADER, 0 );            // No header in the result
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true ); // Return, do not echo result
curl_setopt( $ch, CURLOPT_POST, 1 );              // This is a POST request
curl_setopt( $ch, CURLOPT_POSTFIELDS, array(      // Data to POST
        'url'      => $url,
		'format'   => 'json',
		'action'   => 'shorturl',
		'username' => $credentials['yourlsUsername'],
		'password' => $credentials['yourlsPassword']
	) );

// Fetch and return content
$data = curl_exec($ch);
curl_close($ch);

// Do something with the result. Here, we echo the long URL
$data = json_decode( $data );

echo 'Short url created: ' . $data->shorturl . '<br>';


// Init the CURL session
$ch = curl_init();
curl_setopt( $ch, CURLOPT_URL, 'https://'. $_SERVER['SERVER_NAME'] . '/yourls_api/webhook-to-mautic-api/create-contact.php' );
curl_setopt( $ch, CURLOPT_HEADER, 0 );            // No header in the result
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true ); // Return, do not echo result
curl_setopt( $ch, CURLOPT_POST, 1 );              // This is a POST request
curl_setopt( $ch, CURLOPT_POSTFIELDS, array(      // Data to POST
		'url' => $data->shorturl,
		'url_field_name' => $returnto,
        'email' => $email
	) );

// Fetch and return content
$data = curl_exec($ch);
curl_close($ch);

echo($data);
