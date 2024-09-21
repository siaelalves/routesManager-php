<?php
namespace routes\api\threads ;

class oauth {

 public \routes\url $authorize_url ;
 public string $code = "" ;
 public THREADS_KEYS | APP_KEYS $client_id ;
 public \routes\url $redirect ;
 public string $scopes ;
 public string $state ;
 public token $token ;

 public \routes\url $oauth_url ;
 public string $oauth_parameters ;

 public \routes\url $token_url ;
 public string $token_parameters ;



 public function __construct ( array $scopes = [ SCOPES::BASIC ] , string $state = "" ) {

  $this->authorize_url = new \routes\url ( URIs::AUTHORIZE->value ) ;
  $this->token_url = new \routes\url ( URIs::GET_TOKEN->value ) ;
  $this->client_id = THREADS_KEYS::ID ;
  $this->redirect = new \routes\url ( URIs::REDIRECT->value ) ;
  $this->scopes = $this->set_scopes ( $scopes ) ;
  $this->state = $state ;

  $this->oauth_url = $this->set_auth_url ( ) ;

 }

 public function get_token ( ) : token|bool {
  
  $this->token_url = $this->set_token_url ( ) ;
  $curl = curl_init ( ) ;
  curl_setopt ( $curl , CURLOPT_URL , URIs::GET_TOKEN->value ) ;
  curl_setopt ( $curl , CURLOPT_POST , 1 ) ;
  curl_setopt ( $curl , CURLOPT_POSTFIELDS , $this->token_parameters ) ;
  curl_setopt ( $curl , CURLOPT_RETURNTRANSFER, true);
  
  $response = curl_exec ( $curl ) ;
  $token_obj = json_decode ( $response , true ) ;
  curl_close ( $curl ) ;

  if ( key_exists ( "error" , $token_obj ) == true ) {
   echo $response . "</br>";
   echo "Function: oauth->get_token ( )</br>" ;
   return false ;
  }

  $token = new token ( ) ;
  $token->access_token = $token_obj [ "access_token" ] ;
  $token->user_id = $token_obj [ "user_id" ] ;

  return $token ;

 }

 public function get_code ( ) {

  if ( isset ( $_GET [ "code"] ) ) {

   if ( $_GET [ "code" ] != "" ) {

    return rtrim ( $_GET [ "code" ] , "#_" ) ;

   }

  }

 }

 public function has_code ( ) {

  if ( $this->code == "" ) {
   
   return false ;

  } else {

   return true ;

  }

 }

 public function get_authorization ( ) {

  header ( "Location:" . $this->oauth_url->full ) ;

 }

 public function start_session ( ) {

  if ( isset ( $_GET [ "code" ] ) ) {
 
   if ( $this->has_session ( ) ) {
  
    $this->retrieve_session ( ) ;
  
   } else {
  
    $this->create_session ( $this->get_code ( ) , $this->get_token ( ) ) ;
  
   }
  
  } else {
  
   if ( $this->has_session ( ) ) {
    
    $this->retrieve_session ( ) ;

   }
  
  }

 }

 public function create_session ( string $new_code , token $new_token ) {

  $this->code = $new_code ;
  $this->token = $new_token ;

  $_SESSION [ "th_code" ] = $new_code ;
  $_SESSION [ "th_token" ] = $new_token ;

  return ;

 }

 public function has_session ( ) {

  if ( isset ( $_SESSION [ "th_token" ] ) ) {

   if ( $_SESSION [ "th_token" ] != null ) {

    return true ;

   }

   return false ;

  }

  return false ;

 }

 public function retrieve_session ( ) {

  $token = new \routes\api\threads\token ( ) ;

  $this->code = $_SESSION [ "th_code" ] ;
  $token = $_SESSION [ "th_token" ] ;

  if ( $token->is_bearer ( ) == true ) {   
   $token->expires_in = $_SESSION [ "th_token" ]->expires_in ;   
  }

  $token->check ( ) ;
  $this->update_session ( $token ) ;

  return ;

 }

 public function update_session ( token $new_token ) {
  
  $_SESSION [ "th_token" ] = $new_token ;
  $this->token = $new_token ;
  return ;

 }

 private function set_scopes ( array $scopes ) : string {

  $scope_list = [ ] ;

  foreach ( $scopes as $scope ) {
   array_push ( $scope_list , $scope->value ) ;
  }

  return implode ( "," , $scope_list ) ;

 }

 private function set_auth_url ( ) : \routes\url {
  
  $this->oauth_parameters = http_build_query ( [ "client_id" => $this->client_id->value , "redirect_uri" => $this->redirect->full , "scope" => $this->scopes , "response_type" => "code" , "state" => $this->state ] ) ;
  return new \routes\url ( $this->authorize_url->full . "?" . $this->oauth_parameters ) ;

 }

 private function set_token_url ( ) : \routes\url {

  $this->token_parameters = http_build_query ( [ "client_id" => $this->client_id->value , "client_secret" => THREADS_KEYS::SECRET_KEY->value , "code" => $this->code , "grant_type" => GRANT_TYPE::AUTHORIZATION->value , "redirect_uri" => $this->redirect->full ] ) ;  
  return new \routes\url ( $this->token_url->full . "?" . $this->token_parameters ) ;

 }

}