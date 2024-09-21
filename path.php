<?php
namespace routes ;

class path {
 
 /** Caminho da Url completo sem incluir a barra inicial. */
 public $full;
 /** Array de strings em que cada elemento representa uma parte de um caminho de Url dividido pela barra "/". */
 public $parts = [];
 /** String que representa a última parte de uma Url. */
 public $last_part;
 /** String que representa a penúltima parte de uma Url. */
 public $second_to_last;
 /** Integer que representa a quantidade de partes que há na Url. */
 public $lenght;

 public function __construct( $url_path ) {

  $this->full = $url_path;
  $this->parts = explode ( "/" , $url_path );
  $this->last_part = $this->parts [ count ( $this->parts ) - 1 ];
  $this->lenght = count ( $this->parts );

  if ( count ( $this->parts ) - 2 < 0 ) {
   $this->second_to_last = "" ;
  } else {
   $this->second_to_last = $this->parts [ count ( $this->parts ) - 2 ];
  }
  
 }
 
}

?>