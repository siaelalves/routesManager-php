<?php
namespace routes ;

class query {
 
 /** String com todos os parâmetros da Url. */
 public $full;
 /** Matriz associativa onde cada chave e valor é relacionada aos parâmetros de Url. */
 public $parameters = [];
 /** Matriz com os nomes das chaves de cada parâmetro. */
 public $keys = [];
 /** Matriz com os valores de cada chave dos parâmetros. */
 public $values = []; 

 public function __construct ( $url_query ) {

  if ( $url_query != "" ) {

   $this->full = $url_query;

   $this->parameters = explode ( "&" , $url_query ) ;

   foreach ( $this->parameters as $parameter ) {
    array_push ( $this->keys , explode ( "=" , $parameter )[0] ) ;
   }

   foreach ( $this->parameters as $parameter ) {
    array_push ( $this->values , explode ( "=" , $parameter )[1] ) ;
   }

   // parâmeteros para uma matriz associativa
   $this->parameters = [];
   $v = 0 ;
   foreach ( $this->keys as $key ) {
    $this->parameters["$key"] = $this->values[$v];
    $v++;
   }

  }

 }

}

?>