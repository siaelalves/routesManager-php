<?php
namespace routes ;

/**
 * Permite identificar e obter o tipo de conteúdo da página Web. O tipo de 
 * conteúdo é uma parte do cabeçalho HTTP que indica o tipo de conteúdo que 
 * está sendo transmitido na página Web. Por exemplo, o tipo de conteúdo 
 * pode ser "text/html" ou "text/json". Esta classe permite que você 
 * identifique o tipo de conteúdo, a codificação de transferência e o tipo 
 * de conteúdo completo.
 * 
 * @author Siael Alves
 * @copyright (c) Copyright 2024, Siael Alves
 * @link Indisponível
 */
class content_type {

 /**
  * @var mime Representa o tipo de conteúdo da página Web.
  */
 public mime $mime ;

 /**
  * @var string Representa a codificação de transferência do conteúdo da 
  * página Web.
  */
 public string $encoding ;

 /**
  * @var string Representa o tipo de conteúdo completo da página Web. 
  * Exemplo: se o tipo de conteúdo for "text/html" e a codificação de 
  * transferência for "utf-8", `$full` retornará `text/html; charset=utf-8`.
  */
 public string $full ;
 


 /**
  * Construtor da classe `content_type`.
  * @param string $content_type Expressão em forma de texto que deve 
  * representar o tipo de conteúdo da página Web. O valor de `$content_type` 
  * deve ser algo como `text/html; charset=utf-8`.
  */
 public function __construct ( string $content_type ) {

  $data = explode ( ";" , $content_type , 2 ) ;
  $data [ 1 ] = trim ( $data [ 1 ] , " " ) ;

  $this->mime = new mime ( $data [ 0 ] ) ;
  $this->encoding = explode ( "=" , $data [ 1 ] , 2 ) [ 1 ] ;
  $this->full = $this->mime->full . "; " . "charset=" . $this->encoding ;

 }
 
}