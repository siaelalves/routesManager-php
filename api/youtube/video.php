<?php
namespace routes\api\youtube ;

class video {

 public string $id ;
 public \routes\url $url ;
 public string $publishedAt ;
 public string $title ;
 public string $description ;
 public thumbnail $thumbnail ;



 public function __construct ( $video_obj ) {

  $this->id = $video_obj [ "id" ] [ "videoId" ] ;

  $this->url = new \routes\url ( "https://www.youtube.com/watch?v=" . $this->id ) ;

  $this->publishedAt = $video_obj [ "snippet" ] [ "publishedAt" ] ;
  
  $this->title = $video_obj [ "snippet" ] [ "title" ] ;

  $this->description = $video_obj [ "snippet" ] [ "description" ] ;

  $this->thumbnail = new thumbnail ( $video_obj [ "snippet" ] [ "thumbnails" ] ) ;

 }

}