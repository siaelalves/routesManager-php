<?php
namespace routes ;

/**
 * Dá acesso ao tipo MIME do conteúdo obtido pela Web.
 */
class mime {

 /**
  * @var string Representa o texto do tipo principal do MIME, a primeira 
  * parte antes da barra "/". Exemplo: se o MIME de uma página Web 
  * for "text/html", `$type` assumirá o valor "text".
  */
 public string $type ;

 /**
  * @var string Representa o texto do tipo secundário do MIME, a segunda 
  * parte, do lado direito da barra "/". Exemplo: se o MIME de 
  * uma página Web for "text/json", `$subtype` assumirá o valor 
  * "json".
  */
 public string $sub_type ;

 /**
  * @var string Representa o texto composto por todas as partes 
  * do MIME. Exemplo: se o MIME de uma página Web for "text/html", 
  * `$full` assumirá o valor "text/html".
  */
 public string $full ;



 /**
  * Construtor da classe `mime`.
  * @param string $expression Expressão em forma de texto que deve 
  * representar o tipo MIME do conteúdo da página Web. O valor de 
  * `$expression` deve ser algo como "text/html".
  */
 public function __construct ( string $expression ) {

  $data = explode ( "/" , $expression ) ;

  $this->type = $data [ 0 ] ;
  $this->sub_type = $data [ 1 ] ;
  $this->full = $this->type . "/" . $this->sub_type ;

 }

}