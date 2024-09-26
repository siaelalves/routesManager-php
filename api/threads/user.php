<?php
namespace routes\api\threads ;

use \routes\url ;
use \routes\request ;

class user {

 public string $id ;
 public string $username ;
 public string $name ;
 public url $profile_picture_url ;
 public string $biography ;

 public int $views ;
 public int $likes ;
 public int $replies ;
 public int $reposts ;
 public int $quotes ;
 public int $followers ;



 public function __construct ( ) {

  $user_data = $this->get_user_data ( ) ;

  $this->id = $user_data [ "id" ] ;
  $this->username = $user_data [ "username" ] ;
  $this->name = $user_data [ "name" ] ;
  $this->profile_picture_url = new url ( $user_data [ "threads_profile_picture_url" ] ) ;
  $this->biography = $user_data [ "threads_biography" ] ;

  $insight_data = $this->get_insights ( ) ;

  $this->views = $insight_data [ "views" ] ;
  $this->likes = $insight_data [ "likes" ] ;
  $this->replies = $insight_data [ "replies" ] ;
  $this->reposts = $insight_data [ "reposts" ] ;
  $this->quotes = $insight_data [ "quotes" ] ;
  $this->followers = $insight_data [ "followers_count" ] ;

 }

 public function get_followers_string ( ) {

  if ( $this->followers == 0 || $this->followers > 1 ) {

   return $this->followers . " seguidores" ;

  } else if ( $this->followers == 1 ) {

   return $this->followers . " seguidor" ;

  }

 }

 private function get_user_data ( ) {

  $parameters = http_build_query ( ["fields" => "id,username,name,threads_profile_picture_url,threads_biography" , "access_token" => THREADS_KEYS::ACCESS_TOKEN->value ] ) ;  

  $request = new request ( ) ;
  $request->url = new url ( URIs::USER_DATA->value . "?" . $parameters ) ;

  $user_data = json_decode ( $request->get ( ) , true ) ;

  return $user_data ;

 }

 private function get_insights ( ) : array|bool {

  $thread_insight = [ ] ;

  $parameters = http_build_query ( [ "metric" => "views,likes,replies,reposts,quotes,followers_count" , "access_token"=>THREADS_KEYS::ACCESS_TOKEN->value ] ) ;
  
  $request = new \routes\request ( ) ;
  $request->url = new \routes\url ( URIs::PUBLISH->value . "/" . $this->id . "/" . "threads_insights" . "?" . $parameters ) ;
  
  $insights = json_decode ( $request->get ( ) , true ) ;  

  if ( key_exists ( "data" , $insights ) ) {
   
   foreach ( $insights [ "data" ] as $insight_obj ) {

    $key_name = $insight_obj [ "name" ] ;

    if ( key_exists ( "values" , $insight_obj ) == true ) {
     $thread_insight [ $key_name ] = $insight_obj [ "values" ] [ 0 ] [ "value" ] ;     
    }

    if ( key_exists ( "total_value" , $insight_obj ) == true ) {
     $thread_insight [ $key_name ] = $insight_obj [ "total_value" ] [ "value" ] ;
    }

   }

  } else {
   print_r ( $insights ) ;
   return $insights ;
  }

  return $thread_insight ;
  
 }

}