<?php
namespace routes\api\threads ;

class token {

 public string $access_token ;
 public string $user_id ;
 public string $token_type ;
 public int $expires_in ;

 

 public function exchange ( ) {
  
  $query = [
   "grant_type" => GRANT_TYPE::EXCHANGE->value ,
   "client_secret" => THREADS_KEYS::SECRET_KEY->value ,   
   "access_token" => $this->access_token
  ] ;

  $parameters = http_build_query ( $query ) ;
  $uri = URIs::EXCHANGE_TOKEN->value . "?" . $parameters ;

  $response = file_get_contents ( $uri ) ;  

  if ( $response == null ) {
   echo "token_obj devia ser uma array, mas o valor é null.</br>" ;
   echo "</br>" ;
   echo "Resposta da requisição:</br>" ;
   echo $response . "</br>" ;
   echo "</br>" ;
   echo "URL:</br>";
   echo $uri . "</br>" ;
   echo "</br>";
   echo "Access Token:</br>";
   echo $this->access_token . "</br>" ;
   echo "token->exchange( )</br>" ;
   return ;
  }
  
  $token_obj = json_decode ( $response , true ) ;

  if ( key_exists ( "error" , $token_obj ) == true ) {
   
   print_r ( $token_obj ) . "</br>" ;
   echo "Parameters: " . $parameters . "</br>" ;
   echo "Function : token->exchange ( )" ;

   return ;

  }
  
  $this->access_token = $token_obj [ "access_token" ] ;
  $this->token_type = $token_obj [ "token_type" ] ;
  $this->expires_in = $token_obj [ "expires_in" ] ;

 }

 public function refresh ( ) {

  $query = [
   "grant_type" => GRANT_TYPE::REFRESH->value ,
   "access_token" => $this->access_token
  ] ;

  $parameters = http_build_query ( $query ) ;
  $uri = URIs::REFRESH_TOKEN->value . "?" . $parameters ;

  $response = file_get_contents ( $uri ) ;

  if ( $response == null ) {
   echo "token_obj devia ser uma array, mas o valor é null.</br>" ;
   echo "</br>" ;
   echo "Resposta da requisição:</br>" ;
   echo $response . "</br>" ;
   echo "</br>" ;
   echo "URL:</br>";
   echo $uri . "</br>" ;
   echo "</br>";
   echo "Access Token:</br>";
   echo $this->access_token . "</br>" ;
   echo "token->refresh( )</br>" ;
   return ;
  }

  $token_obj = json_decode ( $response , true ) ;

  if ( key_exists ( "error" , $token_obj ) == true ) {
   
   print_r ( $token_obj ) . "</br>" ;
   echo "Parameters: " . $parameters . "</br>" ;
   echo "Function : token->refresh ( )" ;

   return ;

  }
  
  $this->access_token = $token_obj [ "access_token" ] ;
  $this->token_type = $token_obj [ "token_type" ] ;
  $this->expires_in = $token_obj [ "expires_in" ] ;

 }

 public function check ( ) : array {

  $response = [ "exchanged" => false , "refreshed" => false ] ;

  if ( $this->is_bearer ( ) == false ) {
   
   $this->exchange ( ) ;
   $response [ "exchanged" ] = true ;

  } else {

   if ( $this->is_expired ( ) == true ) {

    $this->refresh ( ) ;
    $response [ "refreshed" ] = true ;

   }

  }

  return $response ;

 }

 public function is_expired ( ) : bool {

  return $this->expires_in == 0 ;

 }

 public function is_bearer ( ) : bool {
  
  if ( isset ( $this->token_type ) ) {
   
   if ( $this->token_type == TOKEN_TYPE::BEARER->value ) {
    return true ;
   }
   
   return false ;

  }

  return false ;

 }

 public function get_object ( ) : array {

  $token_obj = [
   "access_token" => $this->access_token ,
   "user_id"      => $this->user_id ,
   "token_type"   => $this->token_type ,
   "expires_in"   => $this->expires_in
  ] ;

  return $token_obj ;

 }

 public function get_json ( ) : string {

  return json_encode ( $this->get_object ( ) ) ;

 }

}