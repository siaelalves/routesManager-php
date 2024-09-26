<?php
namespace routes\api\youtube ;

class service {

 public string $name ;
 public array $parameters ;
 public \routes\url $api_url ;

 public function __construct ( string $name , array $parameters ) {

  $this->name = $name ;
  $this->parameters = $parameters ;
  $this->api_url = new \routes\url ( URLS::API_URL->value ) ;

 }

 public function run ( ) : array|string {

  $url_parameters = http_build_query ( $this->parameters ) ;
  $url = new \routes\url ( $this->api_url->full . "/" . $this->name . "?" . $url_parameters . "&" . "key=" . KEYS::API_KEY->value ) ;
  return json_decode ( file_get_contents ( $url->full ) , true ) ;

 }

}