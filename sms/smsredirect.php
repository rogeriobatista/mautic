<?php

// PARAMETRO IDENTIFICADOR
$device = $_POST['device'];
$pass = $_POST['pass'];
$url = 'https://smsgateway.truthful.be/api/v4/sms?deviceId='.$device;

// PARAMETRO VARIÃVEL (ESSES DADOS SIM DEVEM SER ALTERADOS A CADA REQUISIÃ‡ÃƒO)
$phone 	= isset($_POST['phone']) ? $_POST['phone'] : "failed";
$msg 	= isset($_POST['msg']) ? $_POST['msg'] : "failed";

// TRATAMENTO SE O VALORE RECEBIDO FOR VAZIO OU NULO
if ($phone 	== "failed" ) 	{echo "error 3"; die;}
if ($msg 	== "failed" ) 	{echo "error 4"; die;}

// TRATAMENTO DE CODIFICAÃ‡ÃƒO
$phone  = urlencode($phone);
$msg  	= urlencode($msg);


// MONTAR O CURL
$curl = curl_init();
curl_setopt_array($curl, array(
	CURLOPT_URL => $url,
	CURLOPT_SSL_VERIFYPEER=>false,           
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_POSTFIELDS => "phone=0$phone&msg=$msg",
	CURLOPT_HTTPHEADER => array	(
		"Authorization: $pass",
		"cache-control: no-cache",
		"content-type: application/x-www-form-urlencoded"
		),
	));
	
// EXECURAR O CURL			
 $response = curl_exec($curl);
 $err = curl_error($curl);
 curl_close($curl);
 
 
// MENSAGEM DE RETORNO
if ($err) {
	
	// SE ERRO NA MONTAGEM DO CURL OU TEMPO DE EXECUCAO
	echo "Error #:" . $err;
	
} else {
	
	//ARMAZENA O STATUS
	$http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

	// SE STATUS MAIOR QUE 400 (erro do servidor)
	if ($http_status > 400) {
		echo "Error:" . $http_status;
	}
	// SE NÃƒO (sucesso)
	else {
		echo "Status: 200 - " . $response;
	}
}

?>