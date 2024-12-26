<?php
namespace routes ;

use DateTime ;

/**
 * Permite identificar e obter cabeçalhos HTTP. O cabeçalho HTTP é uma 
 * mensagem que o servidor envia ao cliente após receber uma requisição 
 * HTTP. O cabeçalho é composto por várias partes, como o tipo de conteúdo, 
 * a codificação de transferência, a conexão, a data, o servidor, o tipo de 
 * conteúdo, o comprimento do conteúdo, a última modificação, o ETag e o 
 * método de requisição. Esta classe permite que você obtenha cada uma 
 * dessas partes do cabeçalho separadamente.
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
 public int $response ;

 /**
  * @var string Representa o servidor que está hospedando a página Web.
  */
 public string $server ;

 /**
  * @var DateTime Representa a data em que a página Web foi acessada.
  */
 public DateTime $date ;

 /**
  * @var content_type Representa o tipo de conteúdo da página Web.
  */
 public content_type $content_type ;

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
 public string $last_modified ;

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
  * Construtor da classe `header`.
  * @param url $url URL da página Web que está sendo acessada.
  */
 public function __construct ( url $url ) {

  $headerData = get_headers ( $url->full , true ) ;  
  
  $this->response = new http_response ( $headerData [ 0 ] ) ;

  $this->server = $headerData [ "Server" ] ;
  
  $this->date = new DateTime ( $headerData [ "Date" ] ) ;
  
  $this->content_type = new content_type ( $headerData [ "Content-Type" ] ) ;

  $this->transfer_encoding = $headerData [ "Transfer-Encoding" ] ;

  $this->connection = $headerData [ "Connection" ] ;

  $this->method = $this->get_method ( ) ;

  $this->body = file_get_contents ( $this->url->full ) ;

 }

 /**
  * Obtém o método de requisição HTTP utilizado.
  * @return REQUEST_METHOD Método de requisição HTTP utilizado.
  */
 private function get_method ( ) : REQUEST_METHOD {

  if ( $_SERVER [ "REQUEST_METHOD" ] == "get" ) {
   
   return REQUEST_METHOD::GET ;

  } else if ( $_SERVER [ "REQUEST_METHOD" ] == "post" ) {

   return REQUEST_METHOD::POST ;

  } else if ( $_SERVER [ "REQUEST_METHOD" ] == "put" ) {

   return REQUEST_METHOD::PUT ;

  } else if ( $_SERVER [ "REQUEST_METHOD" ] == "delete" ) {

   return REQUEST_METHOD::DELETE ;

  }

 }

}