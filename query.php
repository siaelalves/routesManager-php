<?php
namespace routes ;

use TypeError;

/**
 * Manipula a parte da Url que corresponde aos parâmetros de Url. 
 * Permite obter os parâmetros da Url separadamente.
 * 
 * @author Siael Alves
 * @copyright (c) Copyright 2024 - 2025, Siael Alves
 * @link Indisponível
*/
class query {
 
 /**
  * @var string String com todos os parâmetros da Url.
 */
 public string $full = "" ;

 /**
  * @var array Matriz associativa com chaves e valores que correspondem às 
  * chaves e valores dos argumentos da Url.
 */
 public array $parameters = [ ] ;

 /**
  * @var array Matriz com os nomes das chaves de cada parâmetro. 
 */
 public array $keys = [ ] ;

 /**
  * @var array Matriz com os valores de cada chave dos parâmetros. 
 */
 public array $values = [ ] ; 



 /**
  * Construtor da classe `query`.
  * @param $url_query String com argumentos da Url em texto. 
  * Cada argumento deve estar separado pelo símbolo `&`, e suas chaves 
  * e valores devem estar separadas pelo símbolo `=`, exatamente da 
  * forma que apareceria no navegador.
  */
 public function __construct ( $url_query ) {

  if ( $url_query == "" ) {
   $this->full = "" ;
   $this->parameters = [ ] ;
   $this->keys = [ ] ;
   $this->values = [ ] ;
   return ;
  }

  if ( gettype ( $url_query ) != "string" ) {
   throw new TypeError ( "O argumento de construção classe 'query' deve 
   ser do tipo 'string'. Ao invés disso, foi fornecido um tipo " . 
   gettype ( $url_query ) . "." ) ;
  }

  $this->full = $url_query;

  if ( !str_contains ( $this->full , "&" ) ) {
   $this->parameters = [ ] ;
   $this->keys = [ ] ;
   $this->values = [ ] ;
   return ;
  }

  $this->parameters = explode ( "&" , $this->full ) ;

  $valid_parameters = array_filter ( $this->parameters , function ( $parameter ) { 
   return str_contains ( $parameter , "=" ) ;
  } ) ;

  if ( count ( $valid_parameters ) == 0 ) {
   $this->keys = [ ] ;
   $this->values = [ ] ;
   return ;
  }

  foreach ( $valid_parameters as $parameter ) {
   array_push ( $this->keys , explode ( "=" , $parameter ) [ 0 ] ) ;
  }

  foreach ( $valid_parameters as $parameter ) {
   array_push ( $this->values , explode ( "=" , $parameter ) [ 1 ] ) ;
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