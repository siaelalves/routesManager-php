<?php
namespace routes\api\threads ;

use \routes\url ;

class thread {

 public int $id ;
 public MEDIA_PRODUCT_TYPE|bool $media_product_type ;
 public THREAD_TYPE|bool $media_type ;
 public url|bool $media_url ;
 public url|bool $permalink ;
 public int|bool $user_id ;
 public string|bool $user_name ;
 public string|bool $text ;
 public string|bool $timestamp ;
 public string |bool$shortcode ;
 public $children ;
 public bool $is_quote_post ;

 

 public function __construct ( array $thread_obj ) {

  $this->id = $thread_obj [ "id" ] ;

  if ( key_exists ( "media_product_type" , $thread_obj ) ) {
   $this->media_product_type = MEDIA_PRODUCT_TYPE::tryFrom ( $thread_obj [ "media_product_type" ] ) ;   
  } else {
   $this->media_product_type = false ;
  }

  if ( key_exists ( "media_type" , $thread_obj ) ) {
   $this->media_type = THREAD_TYPE::from ( $thread_obj [ "media_type" ] ) ;
  }else{
   $this->media_type = false ;
  }  

  if ( key_exists ( "media_url" , $thread_obj ) ) {
   $this->media_url = new url ( $thread_obj [ "media_url" ] ) ;
  }else{
   $this->media_url = false ;
  }

  if ( key_exists ( "permalink" , $thread_obj ) ) {
   $this->permalink = new url ( $thread_obj [ "permalink" ] ) ;
  }else{
   $this->permalink = false ;
  }

  if ( key_exists ( "owner" , $thread_obj ) ) {
   $this->user_id = $thread_obj [ "owner" ] [ "id" ] ;
  }else{
   $this->user_id = false ;
  }

  if ( key_exists ( "username" , $thread_obj ) ) {
   $this->user_name = $thread_obj [ "username" ] ;
  }else{
   $this->user_name = false ;
  }

  if ( key_exists ( "text" , $thread_obj ) ) {
   $this->text = $thread_obj [ "text" ] ;
  }else{
   $this->text = false ;
  }

  if ( key_exists ( "timestamp" , $thread_obj ) ) {
   $this->timestamp = $thread_obj [ "timestamp" ] ;
  }else{
   $this->timestamp = false ;
  }

  if ( key_exists ( "shortcode" , $thread_obj ) ) {
   $this->shortcode = $thread_obj [ "shortcode" ] ;
  }else{
   $this->shortcode = false ;
  }

  // $this->children = 

  if ( key_exists ( "is_quote_post" , $thread_obj ) ) {
   $this->is_quote_post = $thread_obj [ "is_quote_post" ] ;
  }else{
   $this->is_quote_post = false ;
  }
  
 }

 public function get_excerpt ( ) {

   return substr ( $this->text , 0 , 144 ) ;  

 }

}