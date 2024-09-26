<?php
namespace routes ;

class header {

 public int $response ;
 public string $date_time ;
 public string $last_modified ;
 public string $e_tag ;
 public int $lenght ;
 public content_type $content_type ;

 public REQUEST_METHOD $method ;
 public string $body ;

 public function __construct ( ) {

  $this->method = $this->get_method ( ) ;
  
  $this->body = file_get_contents ( "php://input" ) ;

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