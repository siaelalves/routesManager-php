<?php
namespace routes\api\threads ;

enum REPLY_AUDIENCE : string {

 case EVERYONE = "EVERYONE" ;

 case ACCOUNTS = "ACCOUNTS_YOU_FOLLOW" ;

 case MENTIONED_ONLY = "MENTIONED_ONLY" ;

}