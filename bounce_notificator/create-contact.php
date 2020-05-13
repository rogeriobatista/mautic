<?php

/*******************************************************************************
  Captura informações de um POST de um webhook e envia para a API do Mautic
********************************************************************************
*
*   @property               Powertic
*   @autor                  Luiz Eduardo - luiz@powertic.com
*   @license                GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
*   @mautic-min-version     2.10.0
*   @TODO: Tratar as exceções
*
*/

include __DIR__ . '/vendor/autoload.php';
use Mautic\Auth\ApiAuth;
use Mautic\MauticApi;
session_start();

include "credentials.php";

// Conecta no objeto de autenticação através da BasicAuth
$initAuth = new ApiAuth();
$auth = $initAuth->newAuth($credentials, 'BasicAuth');

// Objeto do Mautic API
$api = new MauticApi();

// Nova instância do objeto Contact
$contactApi = $api->newApi('contacts', $auth, $mauticUrl);

// Pesquisa o contato pelo e-mail
// "email:luiz@powertic.com"
$email = $_POST['email'];
$response = $contactApi->getList("email:$email");
$json = json_encode($response);
$decodedJson = json_decode($json, true);

$id = 0;
$mautic_data = array();

foreach($decodedJson as $lista)
{
 	foreach($decodedJson["contacts"] as $listaTotal)
  {
    // captura o id do contato caso seja encontrado
    $id                           =     $listaTotal["id"];
    // carrega todos os dados existentes do contato
    $mautic_data                  =     $listaTotal["fields"]["all"];
    // coloque todos os dados que você quer atualizar aqui
    $mautic_data["email"]         =    $_POST['email'];  // customize a variavel
    $mautic_data["firstname"]     =    $_POST['name'];    // customize a variavel
    $mautic_data["phone"]		      =    $_POST['phone'];    // customize a variavel
    break;
  }
  break;
}

// Permite criar um novo contato caso o contato especificado não seja encontrado
$createIfNotFound = true;

// Envia a requisição para o Mautic atualizar ou criar o contato
$contact = $contactApi->edit($id, $mautic_data, $createIfNotFound);

// finalizado
echo "OK";
