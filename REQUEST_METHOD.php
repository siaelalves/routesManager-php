<?php
/* © 2024 Copyright, Siael Alves */
namespace routes ;

/**
 * Determina os tipos de requisições HTTP permitidos no site.
 */
enum REQUEST_METHOD : string {
 
 case GET = "GET" ;

 case POST = "POST" ;

 case PUT = "PUT" ;

 case DELETE = "DELETE" ;

}