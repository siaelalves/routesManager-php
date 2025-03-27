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

  if ( gettype ( $url_query ) != "string" ) {
   throw new TypeError ( "O argumento de construção classe 'query' deve 
   ser do tipo 'string'. Ao invés disso, foi fornecido um tipo " . 
   gettype ( $url_query ) . "." ) ;
  }

  $this->full = $url_query ;

  parse_str ( $url_query , $this->parameters ) ;

  $this->keys = array_keys ( $this->parameters ) ;

  $this->values = array_values ( $this->parameters ) ;

 }

}