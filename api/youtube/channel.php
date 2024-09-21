<?php
namespace routes\api\youtube ;

class channel {

 public string $channel_id ;
 public string $user_name ;
 public string $title ;
 public \routes\url $link ; 

 public function __construct ( string $channel_id , string $user_name , string $title , \routes\url $link ) {

  $this->channel_id = $channel_id ;
  $this->user_name = $user_name ;
  $this->title = $title ;
  $this->link = $link ;
  
 }

 public function get_subscribers ( bool $include_string = false ) : int|string|bool {

  $service = new \routes\api\youtube\service ( "channels" , [ "part" => "statistics" , "forHandle" => "@" . $this->user_name ] ) ;
  $data = $service->run ( ) ;

  foreach ( $data [ "items" ] as $item ) {

   if ( $item [ "id" ] == $this->channel_id ) {

    if ( $include_string == false ) {
     
     return $item [ "statistics" ] [ "subscriberCount" ] ;

    } else {

     if ( $item [ "statistics" ] [ "subscriberCount" ] == 1 ) {

      return $item [ "statistics" ] [ "subscriberCount" ] . " inscrito" ;

     } else {

      return $item [ "statistics" ] [ "subscriberCount" ] . " inscritos" ;

     }

    }

   }

  }

  return false ;

 }

 public function get_views ( bool $include_string = false ) : int|string|bool {

  $service = new \routes\api\youtube\service ( "channels" , [ "part" => "statistics" , "forHandle" => "@" . $this->user_name ] ) ;
  $data = $service->run ( ) ;

  foreach ( $data [ "items" ] as $item ) {

   if ( $item [ "id" ] == $this->channel_id ) {

    if ( $include_string == false ) {
     
     return $item [ "statistics" ] [ "viewCount" ] ;

    } else {

     if ( $item [ "statistics" ] [ "viewCount" ] == 1 ) {

      return $item [ "statistics" ] [ "viewCount" ] . " visualização" ;

     } else {

      return $item [ "statistics" ] [ "viewCount" ] . " visualizações" ;

     }

    }

   }

  }

  return false ;

 }

 public function get_videos (  ) : array {

  $service = new \routes\api\youtube\service ( "search" , [ "part" => "snippet" , "channelId" => $this->channel_id ] ) ;
  $data = $service->run ( ) ;  

  $video_list = [ ] ;

  foreach ( $data [ "items" ] as $item ) {

   if ( $item [ "id" ] [ "kind" ] == "youtube#video" ) {

    if ( $item [ "snippet" ] [ "channelId" ] == $this->channel_id ) {
    
     array_push ( $video_list , $item ) ;
 
    }

   }

  }

  return $video_list ;

 }

}