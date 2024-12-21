<?php
namespace routes ;

class http_version {

 public string $protocol ;
 public string $version ;
 public string $full ;

 public function __construct ( string $http_version ) {

  $data = explode ( "/" , $http_version ) ;

  $this->protocol = $data [ 0 ] ;
  $this->version = $data [ 1 ] ;
  $this->full = $this->protocol . "/" . $this->version ;

 }

}