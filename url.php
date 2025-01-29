<?php
namespace routes ;

/**
 * Manipula a Url da rota que se deseja fazer uma requisição. 
 * Permite obter o protocolo, domínio, segmentos e argumentos da Url. 
 * Através da classe `url`, é possível obter os elementos da Url separadamente. 
 * Por exemplo, é possível obter o protocolo, o domínio, os segmentos e os argumentos 
 * da Url.
 * 
 * @author Siael Alves
 * @copyright (c) Copyright 2024 - 2025, Siael Alves
 * @link Indisponível
 */
class url {

 /**
  * Todo a URL incluindo protocolo, domínio, segmentos e argumentos.
 */
 public string $full;

 /**
  * Endereço do website.
  */
 public string $host;

 /**
  * Porta que está especificada na Url. Se não houver, assume o valor de uma string vazia.
  */
 public string $port;

 /**
  * Argumentos de Url utilizadas na solicitação.
 */
 public query $query;

 public string $pass;
 public string $user;
 public string $fragment;

 /**
  * Protocolo utilizado na Url.
  */
 public string $protocol;

 /**
  * Caminho da Url, expressão após o domínio. Se houver alguma barra no final da expressão, 
  * ela é removida.
 */
 public path $path;



 /**
  * Construtor da classe `Url`.
  * @param string $url Url que se deseja manipular.  
  */
 public function __construct ( $url ) {
  
  $this->host = parse_url ( $url , PHP_URL_HOST ) ;
  $this->port = parse_url ( $url , PHP_URL_PORT ) || "" ;
  
  $this->query = new query ( parse_url ( $url , PHP_URL_QUERY ) ) ;

  $this->pass = parse_url ( $url , PHP_URL_PASS ) || "" ;
  $this->user = parse_url ( $url , PHP_URL_USER ) || "" ;
  $this->fragment = parse_url ( $url , PHP_URL_FRAGMENT ) || "" ;
  
  $this->protocol = parse_url ( $url , PHP_URL_SCHEME ) ;
  
  if ( parse_url ( $url , PHP_URL_PATH ) == null ) {

   $this->path = new path ( "" );

  } else {
   
   $this->path = new path ( ltrim ( parse_url ( $url , PHP_URL_PATH ) , "/" ) );

  }  

  $this->full = $this->protocol . ":" . "//" . $this->host . "/" . $this->path->full;

  if ( $this->query->full != "" ) {
   $this->full .= "?" . $this->query->full;
  }

 }
 
}