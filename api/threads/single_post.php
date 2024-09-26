<?php
namespace routes\api\threads ;

use \routes\url ;
use \routes\query ;

class single_post extends post {



 public function __construct ( token $token , string $text ) {

  $this->token = $token ;

  $this->text = $text ;

  $this->is_carrousel_item = false ;
  
  $this->media_type = MEDIA_TYPE::TEXT ;

  $this->api_uri = new url ( URIs::PUBLISH->value . "/" . $this->token->user_id . "/" . "threads" ) ;

  $this->parameters = new query ( $this->set_parameters ( ) ) ;

  $this->token = $token ;

  $this->api_uri = new url ( URIs::PUBLISH->value . "/" . $this->token->user_id . "/" . "threads" ) ;

 }

}