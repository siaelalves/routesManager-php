<?php
namespace routes\api\threads ;

use \routes\url ;
use \routes\query ;

class video_post extends post {



 public function __construct ( token $token , string $text = "" , url $video_url ) {

  $this->token = $token ;

  $this->text = $text ;

  $this->image_url = $video_url ;

  $this->is_carrousel_item = false ;
  
  $this->media_type = MEDIA_TYPE::VIDEO ;

  $this->parameters = new query ( $this->set_parameters ( ) ) ;

  $this->token = $token ;

  $this->api_uri = new url ( URIs::PUBLISH->value . "/" . $this->token->user_id . "/" . "threads" ) ;

 }

}