<?php
namespace routes ;

class mime {

 public string $type ;
 public string $sub_type ;
 public string $full ;

 public function __construct ( string $expression ) {

  $data = explode ( "/" , $expression ) ;

  $this->type = $data [ 0 ] ;
  $this->sub_type = $data [ 1 ] ;
  $this->full = $this->type . "/" . $this->sub_type ;

 }

}