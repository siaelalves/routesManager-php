<?php
namespace routes ;

use DateTime ;

/**
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
 * @copyright (c) Copyright 2024, Siael Alves
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
  * Construtor da classe `header`. Caso a Url pertença ao próprio domínio 
  * do site em que a classe ´header` está sendo inicializada, 
  * certifique-se de que o conteúdo da Url já tenha sido carregado.
  * @param url $url URL da página Web que está sendo acessada.
  */
 public function __construct ( url $url ) {

  $headerData = get_headers ( $url->full , true ) ;  

  $this->url = $url ;

  $this->response = $headerData [ 0 ] ;
  
  $this->server = ( isset($headerData["Server"]) ? $headerData["Server"] : "Undefined" ) ;

  $this->date = ( isset($headerData["Date"]) ? new DateTime($headerData["Date"]) : "Undefined" ) ;
   
  $this->content_type = ( isset($headerData["Content-Type"]) ? new content_type($headerData["Content-Type"]) : "Undefined" ) ;
  
  $this->transfer_encoding = ( isset($headerData["Transfer-Encoding"]) ? $headerData["Transfer-Encoding"] : "Undefined" ) ;
  
  $this->connection = ( isset($headerData["Connection"]) ? $headerData["Connection"] : "Undefined" ) ;

  $this->last_modified = ( isset($headerData["Last-Modified"]) ? new DateTime($headerData["Last-Modified"]) : "Undefined" ) ;
  
  $this->method = $this->get_method ( ) ;
  
  $content = file_get_contents ( $url->full ) ;
  $this->body = ( $content == false ? "Undefined" : $content ) ;
  
 }

 /**
  * Obtém o método de requisição HTTP utilizado.
  * @return REQUEST_METHOD Método de requisição HTTP utilizado.
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

 }

}