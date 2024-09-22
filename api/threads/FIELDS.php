<?php
namespace routes\api\threads ;

enum REPLY_FIELDS : string {

 case ID = "id" ;
 
 case TEXT = "text" ;
 
 case USERNAME = "username" ;
 
 case PERMALINK = "permalink" ;
 
 case TIMESTAMP = "timestamp" ;
 
 case MEDIA_PRODUCT_TYPE = "media_product_type" ;
 
 case MEDIA_TYPE = "media_type" ;
 
 case MEDIA_URL = "media_url" ;
 
 case SHORTCODE = "shortcode" ;
 
 case THUMBNAIL_URL = "thumbnail_url" ;
 
 case CHILDREN = "children" ;
 
 case IS_QUOTE_POST = "is_quote_post" ;
 
 case HAS_REPLIES = "has_replies" ;
 
 case ROOT_POST = "root_post" ;
 
 case REPLIED_TO = "replied_to" ;
 
 case IS_REPLY = "is_reply" ;
 
 case IS_REPLY_OWNED_BY_ME = "is_reply_owned_by_me" ;
 
 case HIDE_STATUS = "hide_status" ;
 
 case REPLY_AUDIENCE = "reply_audience" ;

 case ALL = "id , text , username , permalink , timestamp , media_product_type , media_type , media_url , shortcode , thumbnail_url , children , is_quote_post , has_replies , root_post , replied_to , is_reply , is_reply_owned_by_me , hide_status , reply_audience" ;

}