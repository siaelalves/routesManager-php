<?php
namespace routes\api\youtube ;

class thumbnail {

 public \routes\url $default ;
 public \routes\url $medium ;
 public \routes\url $high ;



 public function __construct ( $thumbnail_obj ) {

  $this->default = new \routes\url ( $thumbnail_obj [ "default" ] [ "url" ] ) ;
  $this->medium = new \routes\url ( $thumbnail_obj [ "medium" ] [ "url" ] ) ;
  $this->high = new \routes\url ( $thumbnail_obj [ "high" ] [ "url" ] ) ;

 }

}