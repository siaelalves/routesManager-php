<?php
namespace routes ;

/**
 * Permite identificar e obter tipo MIME do conteúdo obtido numa página 
 * da Web. O MIME é uma sigla que significa **"Multipurpose Internet Mail 
 * Extensions"** e é um padrão que indica o tipo de conteúdo que está 
 * sendo transmitido na página Web. Por exemplo, o MIME de uma página 
 * Web pode ser **"text/html"** ou **"text/json"**. Esta classe permite que 
 * você **identifique** o tipo e subtipo de um MIME, bem como o MIME
 * completo.
 * 
 * @author Siael Alves
 * @copyright (c) Copyright 2024 - 2025, Siael Alves
 * @link Indisponível
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

  if ( !gettype ( $expression ) == "string" ) {
   echo "O argumento para construir a classe mime precisa ser do 
   tipo <strong>string</strong>. Ao invés disso, foi fornecido 
   um tipo <strong>" . gettype ( $expression ) . "</strong>." ;
   return ;
  }

  if ( strpos ( $expression , "/" ) == false ) {
   echo "O argumento para construir a classe mime precisa ser uma 
   expressão de MIME válida, com tipo e subtipo separados por uma 
   barra: \"/." ;
   return ;
  }

  $data = explode ( "/" , $expression ) ;

  $this->type = $data [ 0 ] ;
  $this->sub_type = $data [ 1 ] ;
  $this->full = $this->type . "/" . $this->sub_type ;

 }

}