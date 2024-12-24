<?php
namespace routes ;

/**
 * Manipula a parte da Url que corresponde aos parâmetros de Url.
 * 
 * @author Siael Alves
 * @copyright (c) Copyright 2024, Siael Alves
 * @link Indisponível
*/
class query {
 
 /**
  * @var string String com todos os parâmetros da Url.
 */
 public string $full;

 /**
  * @var array Matriz associativa com chaves e valores que correspondem às 
  * chaves e valores dos argumentos da Url.
 */
 public $parameters = [ ];

 /**
  * @var array Matriz com os nomes das chaves de cada parâmetro. 
 */
 public $keys = [ ];

 /**
  * @var array Matriz com os valores de cada chave dos parâmetros. 
 */
 public $values = [ ]; 



 /**
  * Construtor da classe `query`.
  * @param string $url_query Argumentos da Url em texto.
  */
 public function __construct ( string $url_query ) {

  if ( $url_query != "" ) {

   $this->full = $url_query;

   $this->parameters = explode ( "&" , $url_query ) ;

   foreach ( $this->parameters as $parameter ) {
    array_push ( $this->keys , explode ( "=" , $parameter ) [0] ) ;
   }

   foreach ( $this->parameters as $parameter ) {
    array_push ( $this->values , explode ( "=" , $parameter )[1] ) ;
   }

   // parâmeteros para uma matriz associativa
   $this->parameters = [ ] ;
   $v = 0 ;
   foreach ( $this->keys as $key ) {
    $this->parameters [ "$key" ] = $this->values [ $v ] ;
    $v++;
   }

  }

 }

}