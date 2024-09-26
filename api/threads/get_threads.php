<?php
namespace routes\api\threads ;

function get_threads ( array $fields = ["id","text","media_url","timestamp","permalink"], string $start_date , string $end_date , int $limit , token $token ) : array {

 $uri = URIs::RETRIEVE->value ;

 $parameters = http_build_query ( [
  "fields" => implode ( "," , $fields ) ,
  "since" => $start_date ,
  "until" => $end_date ,
  "limit" => $limit ,
  "access_token" => $token->access_token
 ] ) ;
 
 $response = file_get_contents ( $uri . "?" . $parameters ) ;
 $threads_data = json_decode ( $response , true ) ;
 
 if ( $threads_data == null ) {

  echo "threads_data devia ser uma array, mas o valor é null.</br>" ;
  echo "</br>" ;
  echo "Resposta da requisição:</br>" ;
  echo $response . "</br>" ;
  echo "</br>" ;
  echo "URL:</br>";
  echo $uri . "?" . $parameters . "</br>" ;
  echo "</br>";
  echo "Access Token:</br>";
  echo $token->access_token . "</br>" ;
  return [ ] ;   

 }

 if ( key_exists ( "error" , $threads_data ) == true ) {
  print_r ( $threads_data ) ;
  echo "URL da API: " .  $uri . "?" . $parameters ;
  return [ ] ;
 }

 return $threads_data [ "data" ] ;

}