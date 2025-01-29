<?php
namespace routes ;

/**
 * Lista os tipos de requisições HTTP permitidos no site.
 * 
 * @author Siael Alves
 * @copyright (c) Copyright 2024 - 2025, Siael Alves
 * @link Indisponível
 */
enum REQUEST_METHOD : string {
 
 case GET = "GET" ;

 case POST = "POST" ;

 case PUT = "PUT" ;

 case DELETE = "DELETE" ;

}