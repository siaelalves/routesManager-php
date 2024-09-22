<?php
namespace routes\api\threads ;

enum THREAD_METRICS : string {

 case VIEWS = "views" ;

 case LIKES = "likes" ;

 case REPLIES = "replies" ;

 case REPOSTS = "reposts" ;

 case QUOTES = "quotes" ;

 case ALL = "views , likes , replies , reposts , quotes" ;

}