<?php
namespace routes ;

use blog\PAGE_TYPE;

/** Organiza informações relativas à Url atual acessada pelo cliente. */
class request {

 private string $http_host;

 /** A primeira parte do Url, podendo o ser "http" ou "https", sem as barras e sem os dois pontos. */
 public string $protocol;

 public header $header ;
 
 /** Última parte da Url requisitada pelo usuário. Exemplo: diariocode.com.br/javascript/novidades-do-javascript; Neste caso, 
  * $request_uri seria "novidades-do-javascript". */
 public string $request_uri;

 /** Tipo de requisição realizada a uma URL. */
 public string $request_method;

 /** Conteúdo de body do cabeçalho HTTP da requisição. */
 public string $body_content;

 /** Endereço raiz do site sem a barra no final incluindo o protocolo. Exemplo: "https://diariocode.com.br". */
 public string $website_root;

 /** Url completa da requisição incluindo protocolo, endereço do site e o restante das pastas em que estiver localizado o conteúdo. */
 public url $url;

 public function __construct() {

  $this->protocol = $this->get_protocol ( ) ;  

  $this->http_host = $_SERVER['HTTP_HOST'];

  $this->request_uri = ltrim( $_SERVER['REQUEST_URI'] , "/" );

  $this->request_method = $_SERVER['REQUEST_METHOD'];

  $this->body_content = file_get_contents("php://input");

  $this->website_root=$this->protocol . "//" . $this->get_website_address();

  $this->url = new url( rtrim($this->website_root . "/" . $this->request_uri , "/") ) ;

  //$this->header = new header ( $this->url ) ;

 }

 /**
  * Obtém o protocolo de segurança que está sendo utilizado pelo servidor.
  * @return string Retorna uma `string` que representa o protocolo seguro 
  * **https:** ou o protocolo inseguro **http:**. Note que a string retornada 
  * inclui sinal de dois-pontos(:), mas não inclui a barra dupla.
  */
 private function get_protocol ( ) : string {

  if ( isset ( $_SERVER [ "HTTPS"] ) ) {
   if ( $_SERVER [ "HTTPS" ] == "on" ) {
    return "https:" ;
   }
  }

  return "http:" ;

 }

 /**
  * Obtém o endreço do website.
  * @return string Retorna uma string que representa o endereço do website. Por 
  * exemplo: "diariocode.com.br" ou "autismofrases.com.br".
  */
 private function get_website_address ( ) : string {

  if ( isset ( $_SERVER [ "SERVER_ADDR" ] ) ) {

   if ( str_starts_with ( $_SERVER [ "SERVER_ADDR" ] , "192.168." ) ) {
    return $_SERVER [ "SERVER_ADDR" ] ;
   }
 
   return $_SERVER [ "SERVER_NAME" ] ;

  }

  return "localhost" ;

 }

 

 /**
  * Realiza uma requisição GET na url especificada na propriedade $url.
  */
 public function get ( ) : string|bool {
  
  return file_get_contents ( $this->url->full ) ;

 }

 /**
  * Realiza uma requisição POST na url especificada na propriedade $url.
  */
 public function post ( ) : string|bool {

  $post = curl_init ( ) ;
  curl_setopt ( $post , CURLOPT_URL , $this->website_root . "/" . $this->url->path->full ) ;
  curl_setopt ( $post , CURLOPT_POST , 1 ) ;
  curl_setopt ( $post , CURLOPT_POSTFIELDS , $this->url->query->full ) ;
  curl_setopt ( $post , CURLOPT_RETURNTRANSFER, true);

  return curl_exec ( $post ) ;

 }

}

?>