<?php
namespace routes ;

use DateTime ;

/**
 * **[EM TESTES]**
 * Permite identificar e obter cabeçalhos HTTP. Note que, se for obter 
 * cabeçalhos do próprio site em que está usando esta classe, é necessário 
 * inicializá-la **depois de ter obtido o conteúdo da página desejada**. 
 * No momento, esta classe consegue obter as seguintes informações de 
 * cabeçalho: 
 * - Server; 
 * - Date; 
 * - Content-Type; 
 * - Transfer-Encoding; 
 * - Connection; 
 * - Last-Modified; 
 * - ETag; 
 * - Método de requisição; 
 * - Corpo da página;  
 * Se a página não possui algum desses dados do cabeçalho, o valor 
 * retornado na propriedade correspondente será uma string de valor 
 * "Undefined".
 * 
 * @author Siael Alves
 * @copyright (c) Copyright 2024 - 2025, Siael Alves
 * @link Indisponível 
 */
class header {

 /**
  * @var url Representa a URL da página Web que está sendo acessada.
  */
 public url $url ;
 
 /**
  * @var http_response Representa a resposta HTTP da página Web que está 
  * sendo acessada.
  */
 public http_response|string $response ;

 /**
  * @var string Representa o servidor que está hospedando a página Web.
  */
 public string $server ;

 /**
  * @var DateTime Representa a data em que a página Web foi acessada.
  */
 public DateTime|string $date ;

 /**
  * @var content_type Representa o tipo de conteúdo da página Web.
  */
 public content_type|string $content_type ;

 /**
  * @var string Representa a codificação de transferência da página Web.
  */
 public string $transfer_encoding ;

 /**
  * @var string Representa a conexão utilizada para acessar a página Web.
  */
 public string $connection ;

 /**
  * @var DateTime Representa a data da última modificação da página Web.
  */
 public DateTime|string $last_modified ;

 /**
  * @var string Representa o ETag da página Web.
  */
 public string $e_tag ;

 /**
  * @var int Representa o comprimento do conteúdo da página Web.
  */
 public int $lenght ;


 /**
  * @var REQUEST_METHOD Representa o método de requisição HTTP utilizado
  */
 public REQUEST_METHOD $method ;

 /**
  * @var string Representa o corpo da página Web.
  */
 public string $body ;

 /**
  * @var string Representa o cabeçalho HTTP puro da página Web.
  */
 public string $raw ;



 /**
  * Construtor da classe `header`. Só funcionará se o domínio da Url for 
  * igual ao domínio do site em que está instalado o PHP.
  * @param request $request Objeto `request` de onde se obterá a Url.
  * @param array $new_header **[EM TESTES]**
  * Array associativa com novos cabeçalhos para a página Web. 
  * Use este parâmetro opcional para substituir os cabeçalhos originais da 
  * página Web. Todos os cabeçalhos serão substituídos. Portanto, caso haja 
  * algum erro na Array, a página Web não será acessada. As chaves da Array 
  * devem corresponder às informações de cabeçalho suportadas, a saber:
  * - 0: Resposta HTTP;
  * - "Server"
  * - "Date"
  * - "Content-Type"
  * - "Transfer-Encoding"
  * - "Connection"
  * - "Last-Modified"
  * - "ETag"
  */
 public function __construct ( request $request , array $new_header = [ ] ) {

  if ( $new_header == [ ] ) {
   $headerData = get_headers ( $request->url->full , true ) ;
  }  else {
   $headerData = $new_header ;
  }

  $this->url = $request->url ;

  $this->response = $headerData [ 0 ] ;
  
  $this->server = ( isset($headerData["Server"]) ? $headerData["Server"] : "Undefined" ) ;

  $this->date = ( isset($headerData["Date"]) ? new DateTime($headerData["Date"]) : "Undefined" ) ;
   
  $this->content_type = ( isset($headerData["Content-Type"]) ? new content_type($headerData["Content-Type"]) : "Undefined" ) ;
  
  $this->transfer_encoding = ( isset($headerData["Transfer-Encoding"]) ? $headerData["Transfer-Encoding"] : "Undefined" ) ;
  
  $this->connection = ( isset($headerData["Connection"]) ? $headerData["Connection"] : "Undefined" ) ;

  $this->last_modified = ( isset($headerData["Last-Modified"]) ? new DateTime($headerData["Last-Modified"]) : "Undefined" ) ;

  $this->e_tag = ( isset ( $headerData [ "ETag" ] ) ? $headerData [ "ETag" ] : "Undefined" ) ;

  $this->lenght = ( isset ( $headerData [ "Content-Length" ] ) ? $headerData [ "Content-Length" ] : 0 ) ;
  
  $this->method = $this->get_method ( ) ;
  
  $content = file_get_contents ( $request->url->full ) ;
  $this->body = ( $content == false ? "Undefined" : $content ) ;

  $this->raw = $this->to_raw ( ) ;

 }

 /**
  * Obtém o método de requisição HTTP utilizado.
  * @return REQUEST_METHOD Método de requisição HTTP utilizado. Caso 
  * não seja possível determinar, retorna "get".
  */
 private function get_method ( ) : REQUEST_METHOD {

  $method = strtolower ( $_SERVER [ "REQUEST_METHOD" ] ) ;

  if ( $method == "get" ) {
   
   return REQUEST_METHOD::GET ;

  } else if ( $method == "post" ) {

   return REQUEST_METHOD::POST ;

  } else if ( $method == "put" ) {

   return REQUEST_METHOD::PUT ;

  } else if ( $method == "delete" ) {

   return REQUEST_METHOD::DELETE ;

  }

  return REQUEST_METHOD::GET ;

 }

 /**
  * Converte os dados de cabeçalho em uma string pura.
  * @return string Dados de cabeçalho em uma string pura.
  */
 private function to_raw ( ) : string {

  return implode("\r\n", [
   $this->response,
   "Server: " . $this->server,
   "Date: " . ($this->date instanceof DateTime ? $this->date->format(DateTime::RFC1123) : $this->date),
   "Content-Type: " . $this->content_type,
   "Transfer-Encoding: " . $this->transfer_encoding,
   "Connection: " . $this->connection,
   "Last-Modified: " . ($this->last_modified instanceof DateTime ? $this->last_modified->format(DateTime::RFC1123) : $this->last_modified),
   "ETag: " . $this->e_tag,
   "Content-Length: " . $this->lenght,
   "\r\n" . $this->body
  ]);

 }

}