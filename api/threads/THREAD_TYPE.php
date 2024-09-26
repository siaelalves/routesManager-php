<?php
namespace routes\api\threads ;

enum THREAD_TYPE : string {

 case TEXT_POST = "TEXT_POST" ;

 case IMAGE = "IMAGE" ;

 case VIDEO = "VIDEO" ;

 case CAROUSEL_ALBUM = "CAROUSEL_ALBUM" ;

 case AUDIO = "AUDIO" ;

 case REPOST_FACADE = "REPOST_FACADE" ;

}