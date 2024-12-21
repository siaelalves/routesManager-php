<?php
namespace routes ;

use DateTime ;

class header {

 public url $url ;
 public int $response ;
 public string $server ;
 public DateTime $date ;
 public content_type $content_type ;
 public string $transfer_encoding ;
 public string $connection ;
 public string $last_modified ;
 public string $e_tag ;
 public int $lenght ;

 public REQUEST_METHOD $method ;
 public string $body ;


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