<?php

/*******************************************************************************
  Configurações da API do Mautic
********************************************************************************
*
*   @property               Powertic
*   @autor                  Luiz Eduardo - luiz@powertic.com
*   @license                GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
*   @mautic-min-version     2.10.0
*   @ TODO: Tratar as exceções
*
*/

$ts = gmdate("D, d M Y H:i:s") . " GMT";
header("Expires: $ts");
header("Last-Modified: $ts");
header("Pragma: no-cache");
header("Cache-Control: no-cache, must-revalidate");

// a url do seu mautic
$mauticUrl = "https://lab.leoborlot.com.br";

// login do Basic Authentication (crie um usuário ou utilize um existente)
$credentials = array(
  'userName' => "leo@leoborlot.com.br",
  'password' => "rogerio12345"
);
