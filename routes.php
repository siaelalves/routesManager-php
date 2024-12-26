<?php
/* © 2024 Copyright, Siael Alves */

/**
 * Organiza classes e funções que manipulam Url e requisições do usuário. 
* Esta classe depende das classes admin e paths.
*/
namespace routes ;

// Enumerador REQUEST_METHOD
require dirname(__FILE__) . "/REQUEST_METHOD.php" ;

// Classe mime
require dirname(__FILE__) . "/mime.php" ;

// Classe content_type
require dirname(__FILE__) . "/content_type.php" ;

// Classe http_version
require dirname(__FILE__) . "/http_version.php" ;

// Classe http_response
require dirname(__FILE__) . "/http_response.php" ;

// Classe http_header
require dirname(__FILE__) . "/header.php" ;

// Classe request
require dirname(__FILE__) . "/request.php" ;

// Classe url
require dirname(__FILE__) . "/url.php" ;

// Classe query
require dirname(__FILE__) . "/query.php" ;

// Classe path
require dirname(__FILE__) . "/path.php" ;

// Namespace api
require dirname(__FILE__) . "/api.php" ;
$my_youtube_channel = new \routes\api\youtube\channel ( api\youtube\KEYS::CHANNEL_ID->value , "diariocode" , "Diário Code" , new \routes\url ( "https://youtube.com/@diariocode" ) ) ;
$my_threads_account = new \routes\api\threads\user ( ) ;