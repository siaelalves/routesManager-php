<?php
namespace routes ;

class content_type {

 public mime $mime ;
 public string $encoding ;
 public string $full ;
 
 public function __construct ( string $content_type ) {

  $data = explode ( ";" , $content_type , 2 ) ;
  $data [ 1 ] = trim ( $data [ 1 ] , " " ) ;

  $this->mime = new mime ( $data [ 0 ] ) ;
  $this->encoding = explode ( "=" , $data [ 1 ] , 2 ) [ 1 ] ;
  $this->full = $this->mime->full . "; " . "charset=" . $this->encoding ;

 }
 
}