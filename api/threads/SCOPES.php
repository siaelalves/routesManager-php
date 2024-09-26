<?php
namespace routes\api\threads ;

enum SCOPES : string {

 case BASIC = "threads_basic" ;
 
 case CONTENT_PUBLISH = "threads_content_publish" ;
 
 case READ_REPLIES = "threads_read_replies" ;
 
 case MANAGE_REPLIES = "threads_manage_replies" ;
 
 case MANAGE_INSIGHTS = "threads_manage_insights" ;

 // case ALL_SCOPES = "threads_basic,threads_content_publish,threads_read_replies,threads_manage_replies,threads_manage_insights" ;

}