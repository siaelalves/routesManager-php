<?php
namespace routes ;

/**
 * Permite identificar a versão do protocolo HTTP utilizada na requisição. 
 * É possível obter o tipo de protocolo utilizado e sua versão.
 * 
 * @author Siael Alves
 * @copyright (c) Copyright 2024 - 2025, Siael Alves
 * @link Indisponível
 */
class http_version {

 /**
  * @var string Representa o tipo de protocolo HTTP utilizado na requisição. 
  * Pode ser "HTTP" ou "HTTPS".
  */
 public string $protocol ;

 /**
  * @var string Representa a versão do protocolo HTTP utilizada na requisição.
  */
 public string $version ;

 /**
  * @var string Representa o protocolo HTTP e sua versão. Exemplo: se a
  * versão do protocolo HTTP for "1.1", `$full` retornará "HTTP/1.1".
  */
 public string $full ;


 
 /**
  * Construtor da classe `http_version`.
  * @param string $http_version Expressão em forma de texto que deve 
  * representar a versão do protocolo HTTP utilizada na requisição. 
  * O valor de `$http_version` deve ser algo como "HTTP/1.1".
  */
 public function __construct ( string $http_version ) {

  $data = explode ( "/" , $http_version ) ;

  $this->protocol = $data [ 0 ] ;
  $this->version = $data [ 1 ] ;
  $this->full = $this->protocol . "/" . $this->version ;

 }

}