<?php
namespace routes ;

/** 
 * Organiza e manipula informações relativas às requisições realizadas pelo cliente.
*/
class request {

 /**
  * @var string Representa o endereço do website para onde é enviada a requisição. Se 
  * a Url a ser requisitada é 
  * "http://diariocode.com.br/blog/linux/como-personalizar-diretorio-padrao-xampp-linux-debian", 
  * o valor de `$http_host` é "diariocode.com.br".
  */
 public string $http_host ;

 /**
  * @var string A primeira parte da Url, podendo o ser "http" ou "https". Não retorna as barras duplas nem os dois pontos. 
 */
 public string $protocol;

 /**
  * @var header $header Dá acesso às informações de cabeçalho da página.
  */
 public header $header ;
 
 /**
  * @var string Última parte da Url requisitada pelo usuário. Exemplo: Na Url 
  * `diariocode.com.br/javascript/novidades-do-javascript`, `$request_uri` retornaria "novidades-do-javascript".
 */
 public string $request_uri;

 /**
  * @var REQUEST_METHOD Tipo de requisição realizada a uma URL. O enumerador 
  * REQUEST_METHOD possui as seguintes constantes e seus respectivos valores: 
  * - GET = "GET"
  * - POST = "POST"
  * - PUT = "PUT"
  * - DELETE = "DELETE 
  */
 public REQUEST_METHOD $request_method;

 /**
  * @var string Conteúdo de body do cabeçalho HTTP da requisição. 
  */
 public string $body_content;

 /**
  * @var string Endereço raiz do site sem a barra no final incluindo o protocolo. 
  * Por exemplo: se o cliente acessar a página "https://diariocode.com.br/python", 
  * `website_root` retornará "diariocode.com.br". 
  */
 public string $website_root;

 /** 
  * @var url Representa a Url completa da requisição incluindo protocolo, endereço do 
  * site e o restante dos segmentos do conteúdo. Através da classe `url`, é possível 
  * obter os elementos da Url separamente.
  */
 public url $url;



 /**
  * Construtor da classe `request`.
  */
 public function __construct ( ) {

  $this->protocol = $this->get_protocol ( ) ;

  $this->http_host = $_SERVER [ 'HTTP_HOST' ] ;

  $this->request_uri = ltrim ( $_SERVER [ 'REQUEST_URI' ] , "/" ) ;

  $this->request_method = REQUEST_METHOD::tryFrom ( $_SERVER [ 'REQUEST_METHOD' ] ) ;

  $this->body_content = file_get_contents ( "php://input" ) ;

  $this->website_root=$this->protocol . "//" . $this->get_website_address ( ) ;

  $this->url = new url ( rtrim ( $this->website_root . "/" . $this->request_uri , "/" ) ) ;

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
  * exemplo: "diariocode.com.br" ou "autismofrases.com.br". Em cso de erro, 
  * por exemplo, se numa rara ocasião não for possível ter acesso às informações 
  * do servidor, retornará "localhost".
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
  * @return string|bool Retorna o conteúdo da requisição no formato String, ou 
  * retorna uma array associativa contendo os detalhes do erro. Essa array 
  * associativa possui as seguintes chaves:
  *
  * - success: em caso de erro, possui o valor `false`. Pode ser usado para 
  * verificar se a requisição foi bem-sucedida ou não;
  * - code: código do erro. Pode representar um erro interno ou um erro de 
  * HTTP;
  * - message: mensagem de erro detalhando o que aconteceu;
  *
  * O endpoint no qual se está fazendo a requisição pode ter mensagens de erro 
  * personalizadas. O tratamento de erro apresentado aqui indicará erros apenas 
  * na tentativa de obter os dados.
  * Visto que as mensagens de erros podem ser lidas pelos visitantes, essas 
  * mensagens não são altamente descritivas.
  */
 public function get ( ) : string|array {
  
  $header = get_headers ( $this->url->full ) ;
  if ( $header && strpos ( $header[0] , '404' ) !== false ) {
   $result = [
    "success" => false ,
    "code" => 404 ,
    "message" => "A URL requisitada não existe. Erro 404." ,
   ] ;

   print_r ( $result ) ;
   return $result ;   
  }

  if ( $header && strpos ( $header[0] , '500' ) !== false ) {
   $result = [
    "success" => false ,
    "code" => 500 ,
    "message" => "Houve um erro interno no servidor ao requisitar uma URL solicitada. Erro 500." ,
   ] ;

   print_r ( $result ) ;
   return $result ;   
  }

  return file_get_contents ( $this->url->full ) ;

 }

 /**
  * Realiza uma requisição POST na url especificada na propriedade $url.
  * @return string|array Retorna o conteúdo da requisição no formato String, ou 
  * retorna uma array associativa contendo os detalhes do erro. Essa array 
  * associativa possui as seguintes chaves:
  *
  * - success: em caso de erro, possui o valor `false`. Pode ser usado para 
  * verificar se a requisição foi bem-sucedida ou não;
  * - code: código do erro;
  * - message: mensagem de erro detalhando o que aconteceu;
  *
  * O endpoint no qual se está fazendo a requisição pode ter mensagens de erro 
  * personalizadas. O tratamento de erro apresentado aqui indicará erros apenas 
  * na tentativa de obter os dados.
  * Visto que as mensagens de erros podem ser lidas pelos visitantes, essas 
  * mensagens não são altamente descritivas.
  */
 public function post ( ) : string|array {

  $result = "" ;

  $header = get_headers ( $this->url->full ) ;
  if ( $header && strpos ( $header[0] , '404' ) !== false ) {
   $result = [
    "success" => false ,
    "code" => 404 ,
    "message" => "A URL requisitada não existe. Erro 404." ,
   ] ;

   print_r ( $result ) ;
   return $result ;
  }

  if ( $header && strpos ( $header[0] , '500' ) !== false ) {
   $result = [
    "success" => false ,
    "code" => 500 ,
    "message" => "Houve um erro interno no servidor ao requisitar uma URL solicitada. Erro 500." ,
   ] ;

   print_r ( $result ) ;
   return $result ;   
  }

  $post = curl_init ( ) ;
  curl_setopt ( $post , CURLOPT_URL , $this->website_root . "/" . $this->url->path->full ) ;
  curl_setopt ( $post , CURLOPT_POST , 1 ) ;
  curl_setopt ( $post , CURLOPT_POSTFIELDS , $this->url->query->full ) ;
  curl_setopt ( $post , CURLOPT_RETURNTRANSFER, true);

  try {
   
   $result = curl_exec ( $post ) ;

  } catch (\Throwable $th) {
   
   $result = [
    "success" => false ,
    "code" => $th->getCode ( ) ,
    "message" => "Erro na tentativa de fazer uma requisição post. Detalhes do erro: " . $th->getMessage ( ) ,
   ] ;

  }

  return $result ;

 }

}