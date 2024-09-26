<?php
namespace routes\api\threads ;

use \routes\url ;
use \routes\query ;

class image_post extends post {



 public function __construct ( token $token , string $text = "" , url $image_url ) {

  $this->token = $token ;

  $this->text = $text ;

  $this->image_url = $image_url ;

  $this->is_carrousel_item = false ;
  
  $this->media_type = MEDIA_TYPE::IMAGE ;

  $this->parameters = new query ( $this->set_parameters ( ) ) ;

  $this->token = $token ;

  $this->api_uri = new url ( URIs::PUBLISH->value . "/" . $this->token->user_id . "/" . "threads" ) ;

 }

}