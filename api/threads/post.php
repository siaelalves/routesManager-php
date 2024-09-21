<?php
namespace routes\api\threads ;

use \routes\url ;
use \routes\query ;

class post {

 public string $text ;
 public url $image_url ;
 public url $video_url ;
 public bool $is_carrousel_item ;
 public MEDIA_TYPE $media_type ;

 public token $token ;
 public query $parameters ;
 public url $api_uri ;



 public function __construct ( token $token ) {

  $this->token = $token ;

  $this->api_uri = new url ( URIs::PUBLISH->value . "/" . $this->token->user_id . "/" . "threads" ) ;

 }

 public function publish ( ) {

  $container = $this->get_container ( ) ;
  
  $curl = curl_init ( ) ;
  curl_setopt ( $curl , CURLOPT_URL , URIs::PUBLISH->value . "/" . $this->token->user_id . "/" . "threads_publish" ) ;
  curl_setopt ( $curl , CURLOPT_POST , 1 ) ;
  curl_setopt ( $curl , CURLOPT_POSTFIELDS , http_build_query ( [ "creation_id" => $container [ "id" ] , "access_token" => $this->token->access_token ] ) ) ;
  curl_setopt ( $curl , CURLOPT_RETURNTRANSFER, true);
  
  $response = curl_exec ( $curl ) ;
  $threads = json_decode ( $response , true ) ;

  curl_close ( $curl ) ;

  if ( key_exists ( "id" , $threads ) == true ) {

   return true ;

  } else {

   return $response ;

  }

 }

 private function get_container ( ) : array {

  $curl = curl_init ( ) ;
  curl_setopt ( $curl , CURLOPT_URL , $this->api_uri->full ) ;
  curl_setopt ( $curl , CURLOPT_POST , 1 ) ;
  curl_setopt ( $curl , CURLOPT_POSTFIELDS , $this->parameters->full ) ;
  curl_setopt ( $curl , CURLOPT_RETURNTRANSFER, true);
  
  $response = curl_exec ( $curl ) ;
  $container = json_decode ( $response , true ) ;

  curl_close ( $curl ) ;

  if ( key_exists ( "id" , $container ) == true ) {

   return $container ;

  } else if ( key_exists ( "error" , $container ) == true ) {

   print_r ( $container ) ;
   echo "URL de referência: " . $this->api_uri->full  . "?" . $this->parameters->full . "</br>";
   exit ( ) ;
   
  }

 }

 public function set_parameters ( ) : string {

  if ( $this->media_type == MEDIA_TYPE::TEXT ) {

   $query = [
    "media_type"        => $this->media_type->value ,
    "text"              => $this->text ,
    "is_carrousel_item" => $this->is_carrousel_item ,
    "access_token"      => $this->token->access_token
   ] ;

  } else if ( $this->media_type == MEDIA_TYPE::IMAGE ) {

   if ( $this->text != "" ) {

    $query = [
     "media_type"        => $this->media_type->value ,
     "text"              => $this->text ,
     "is_carrousel_item" => $this->is_carrousel_item ,
     "image_url"         => $this->image_url->full ,
     "access_token"      => $this->token->access_token
    ] ;

   } else {

    $query = [
     "media_type"        => $this->media_type->value ,
     "is_carrousel_item" => $this->is_carrousel_item ,
     "image_url"         => $this->image_url->full ,
     "access_token"      => $this->token->access_token
    ] ;

   }

  } else if ( $this->media_type == MEDIA_TYPE::VIDEO ) {

   $query = [
    "media_type"        => $this->media_type->value ,
    "text"              => $this->text ,
    "is_carrousel_item" => $this->is_carrousel_item ,
    "video_url"         => $this->video_url->full ,
    "access_token"      => $this->token->access_token
   ] ;

  }


  return http_build_query ( $query ) ;

 }

}

// HERANÇAS

require "single_post.php" ;

require "image_post.php" ;

require "video_post.php" ;