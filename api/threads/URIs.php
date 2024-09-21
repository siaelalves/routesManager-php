<?php
namespace routes\api\threads ;

enum URIs : string {

 case REDIRECT = "https://diariocode.com.br/blogly/configuracoes/integracoes" ;

 case AUTHORIZE = "https://threads.net/oauth/authorize" ;


 case GET_TOKEN = "https://graph.threads.net/oauth/access_token" ;
 
 case EXCHANGE_TOKEN = "https://graph.threads.net/access_token" ;

 case REFRESH_TOKEN = "https://graph.threads.net/refresh_access_token" ;


 case RETRIEVE = "https://graph.threads.net/v1.0/me/threads" ;
 
 case PUBLISH = "https://graph.threads.net/v1.0" ;

}