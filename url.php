<?php
namespace routes ;


class url {

 /** Todo a URL incluindo protocolo, domínio e pastas */
 public string $full;
 /** Endereço do website. */
 public string $host;
 public string $port;
 /** Argumentos de Url. */
 public query $query;
 public string $pass;
 public string $user;
 public string $fragment;
 public string $protocol;
 /** Página acessada, sem os argumentos de Url e sem o protocolo. A barra inicial é removida. */
 public path $path;

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

?>