<?php
namespace routes ;

class http_response {

 public http_version $http_version ;
 public int $status_code ;
 public string $reason ;
 public string $full ;

 function __construct ( string $response ) {

  $data = explode ( " " , $response , 3 ) ;

  $this->http_version = new http_version ( $data [ 0 ] ) ;
  $this->status_code = (int)$data [ 1 ] ;
  $this->reason = $data [ 2 ] ;
  $this->full = $this->http_version->full . " " . $this->status_code . " " . $this->reason ;

 }

}