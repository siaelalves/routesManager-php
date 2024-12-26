<?php
namespace routes ;

/**
 * Permite identificar e obter respostas HTTP. A resposta HTTP é uma 
 * mensagem que o servidor envia ao cliente após receber uma requisição 
 * HTTP. A resposta é composta por um código de status, uma mensagem de 
 * status e o corpo da resposta. Esta classe permite que você obtenha 
 * cada uma dessas partes da resposta separadamente.
 * 
 * @author Siael Alves
 * @copyright (c) Copyright 2024, Siael Alves
 * @link Indisponível
 */
class http_response {

 /**
  * @var http_version Representa a versão do protocolo HTTP utilizada 
  * na resposta HTTP.
  */
 public http_version $http_version ;

 /**
  * @var int Representa o código de status da resposta HTTP. O código
  * de status é um número de três dígitos que indica o resultado da 
  * requisição. Exemplos de códigos de status são 200, 404 e 500.
  */
 public int $status_code ;

 /**
  * @var string Representa a mensagem de status da resposta HTTP. A 
  * mensagem de status é uma descrição textual do código de status. 
  * Exemplos de mensagens de status são "OK", "Not Found" e "Internal 
  * Server Error".
  */
 public string $reason ;

 /**
  * @var string Representa a resposta HTTP completa, composta pela 
  * versão do protocolo HTTP, o código de status e a mensagem de status.  
  */
 public string $full ;


 
 /**
  * Construtor da classe `http_response`.
  * @param string $response Expressão em forma de texto que deve 
  * representar a resposta HTTP. O valor de `$response` deve ser algo 
  * como "HTTP/1.1 200 OK".
  */
 public function __construct ( string $response ) {

  $data = explode ( " " , $response , 3 ) ;

  $this->http_version = new http_version ( $data [ 0 ] ) ;
  $this->status_code = (int)$data [ 1 ] ;
  $this->reason = $data [ 2 ] ;
  $this->full = $this->http_version->full . " " . $this->status_code . " " . $this->reason ;

 }

}