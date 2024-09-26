<?php
namespace routes\api\threads ;

enum GRANT_TYPE : string {

 case AUTHORIZATION = "authorization_code" ;

 case EXCHANGE = "th_exchange_token" ;

 case REFRESH = "th_refresh_token" ;

}