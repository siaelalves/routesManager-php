<?php
namespace routes ;

use blog\PAGE_TYPE;

/** Organiza informações relativas à Url atual acessada pelo cliente. */
class request {

 private string $http_host;

 /** A primeira parte do Url, podendo o ser "http" ou "https", sem as barras e sem os dois pontos. */
 public string $protocol;
 
 /** Última parte da Url requisitada pelo usuário. Exemplo: diariocode.com.br/javascript/novidades-do-javascript; Neste caso, 
  * $request_uri seria "novidades-do-javascript". */
 public string $request_uri;

 /** Tipo de requisição realizada a uma URL. */
 public string $request_method;

 /** Conteúdo de body do cabeçalho HTTP da requisição. */
 public string $body_content;

 /** Endereço raiz do site sem a barra no final incluindo o protocolo. Exemplo: "https://diariocode.com.br". */
 public string $website_root;

 /** Url completa da requisição incluindo protocolo, endereço do site e o restante das pastas em que estiver localizado o conteúdo. */
 public url $url;

 public function __construct() {

  $this->protocol = $this->set_protocol();

  $this->http_host = $_SERVER['HTTP_HOST'];

  $this->request_uri = ltrim( $_SERVER['REQUEST_URI'] , "/" );

  $this->request_method = $_SERVER['REQUEST_METHOD'];

  $this->body_content = file_get_contents("php://input");

  $this->website_root=$this->protocol . "//" . $this->set_website_address();

  $this->url = new url( rtrim($this->website_root . "/" . $this->request_uri , "/") ) ;

 }

 public function get_last_part_of_url( $url_to_get ) {
  global $request;

  $url_to_get = str_replace( $request->website_root , "" , $url_to_get );
 
  $url_parts = explode( "/" , $url_to_get );

  $last_index = count( $url_parts ) - 1;

  $last_part = $url_parts[$last_index];

  return $last_part;

 }

 public function get_url_no_last_part ( $url_to_get ) {
  global $request ;

  $url_to_get = str_replace( $request->website_root , "" , $url_to_get );

  $url_parts = explode( "/" , $url_to_get );

  $last_index = count( $url_parts ) - 1;

  array_splice ( $url_parts , $last_index ) ;

  $url_no_last_part = implode ( "/" , $url_parts );

  return $url_no_last_part;

 }

 public function set_protocol() {

  if ( SECURE_URL == true && LOCAL_MODE == false ) {
   return "https:";
  } else {
   return "http:";
  }

 }

 public function set_website_address() {
  global $admin ;
  
  if ( LOCAL_MODE == true ) {
   return $admin->config["localIp"];
  } else {
   return $admin->website["address"];
  }

 }

 /**
  * Registra um acesso a uma URL e salva no banco de dados.
  */
 public function register_access ( ) {
  global $admin , $paths ;

  if ( $this->url->path->full == "favicon.ico" ) {
   return ;
  }

  $statistics = [] ;
  $statistics = $admin->statistics ;
  try {
   $id_stats = count ( $statistics ) ;
  } catch (\Throwable $th) {
   $id_stats = 0 ;
  }
  $new_data = [
   "id" => $id_stats ,
   "url" => $this->url->path->full ,
   "type" => "" ,
   "dateTime" => date ( $admin->date_time_formats["json"] )
  ];

  array_push ( $statistics , $new_data ) ;  
  file_put_contents ( $paths->statistics_db , json_encode ( $statistics ) ) ;

 }
 
 /**
  * Obtém o conteúdo de uma página de acordo com o tipo de requisição realizada.
  * @param string $url_to_load URL cujo conteúdo deverá ser obtido.
  */
 function load_url( $url_to_load ) {
  global $admin, $request , $paths , $query; // não remover $request e $paths
  
  $url_to_load = new url ( rtrim ( $url_to_load , "/" ) );
  
  /* Registra um acesso ao log de estatísticas */
  if ( $admin->config["saveStatistics"] == true ) {
   $this->register_access ( );
  }

  $page_obj = $query->get_page_by_url ( $url_to_load ) ;

  // Adicionar middlewares aqui

  //

  $this->get_page_content ( $page_obj ) ;

 }

 private function get_page_content ( $page_obj ) {
  global $admin, $request , $paths , $query; // não remover $request e $paths

  if ( gettype ( $page_obj ) == "array" ) {
   $page = new \blog\page ( $page_obj ) ;
   $this_page = $page ; // não remover esta linha

   /* Carrega o conteúdo de página administrativa. */   
   if ( $this->is_admin_page ( ) == true ) {
    /* Adicionar middlewares aqui
  
    */
    $this->load_admin ( $page ) ;
    return ;
   }

   /* Carrega o conteúdo de uma página pública comum */   
   if ( $this->is_admin_page ( ) == false ) {
    /* Adicionar middlewares aqui
  
    */
    $this->load_public ( $page ) ;
    return ;
   }
  }

  /* Carrega a página 404 */
  if ( gettype ( $page_obj ) == "boolean" ) {
   if ( $page_obj == false ) {
    $this->load_404 ( ) ;
   }   
  }

 }

 public function is_admin_page ( ) : bool {

  return $this->url->path->parts [ 0 ] == "blogly" ;

 }

 private function load_404 ( ) {
  global $admin , $request , $paths , $query ; // não remover esta linha

  $page_obj = [
   "id" => 30,
   "content" => "",
   "title" => "Erro 404 - Página não encontrada", 
   "thumbnail" => 0,
   "description" => "A URL que você acessou não existe. Escolha um dos links no topo da página para utilizar o site.",
   "url" => "404",
   "canonical" => "404",
   "dateTime" => "2024-07-29T15:29:00+00:00",
   "author" => "Diário Code",
   "status" => 2,
   "type" => \blog\PAGE_TYPE::ERROR_404->value,
   "scripts" => [],
   "stylesheet" => ["global.css"]
  ];

  $this_page = new \blog\page ( $page_obj );
  $this_content = $this_page;

  header ( "HTTP/1.0 404 Not Found" , true , 404 );
  include "html/index.php";

  return;

 }

 private function load_admin ( \blog\page $page ) {
  global $admin , $request , $paths , $query ; // não remover esta linha

  $this_page = $page ;
  $this_content = $page; // não apague esta linha

  if ( $page->is_content_page ( ) == true ) {   
    
   include "admin/index.php";
   return ;

  } else if ( $page->is_script_page ( ) == true ) {
   
   include $page->content . ".php";
   return ;

  }

 }

 private function load_public ( \blog\page $page ) {
  global $admin , $request , $paths , $query ;
  
  $this_page = $page ;
  $this_content = $page; // não apague esta linha

  // home
  if ( $page->type == \blog\PAGE_TYPE::HOME->value ) {   
   
   include "html/index.php";
   return ;
  
  // page    
  } else if ( $page->type == \blog\PAGE_TYPE::PAGE->value ) {   

   include "html/index.php";
   return ;

  // post
  } else if ( $page->type == \blog\PAGE_TYPE::POST->value ) {

   $this_post = new \blog\post( ) ;
   $this_post->new ( $query->get_post_by_url($page->url->path->full) ) ;
   $this_content = $this_post; // não apague esta linha

   include "html/index.php";
   return ;
  
  // category
  } else if ( $page->type == \blog\PAGE_TYPE::CATEGORY->value ) {
   
   $this_category = new \blog\category( $query->get_category_by_url($page->url->path->full) );
   $this_content = $this_category; // não apague esta linha

   include "html/index.php";
   return ;

  // tag
  } else if ( $page->type == \blog\PAGE_TYPE::TAG->value ) {
   
   $this_tag = new \blog\tag ( $query->get_tag_by_url ( $page->url->path->full ) ) ;
   $this_content = $this_tag ; // não apague esta linha

   include "html/index.php";
   return ;
  
  // blog
  } else if ( $page->type == \blog\PAGE_TYPE::BLOG->value ) {

   include "html/index.php";
   return ;
  
  // media
  } else if ( $page->type == \blog\PAGE_TYPE::MEDIA->value ) {

   include "html/index.php";
   return ;

  // php_script
  } else if ( $page->type == \blog\PAGE_TYPE::PHP->value ) {
   
   include $this_page->content;
   return ;
   
  } else if ( $page->is_blog_page ( ) == true ) {

   include "html/index.php";
   return ;  

  }

 }

 /**
  * Realiza uma requisição GET na url especificada na propriedade $url.
  */
 public function get ( ) : string|bool {
  
  return file_get_contents ( $this->url->full ) ;

 }

 /**
  * Realiza uma requisição POST na url especificada na propriedade $url.
  */
 public function post ( ) : string|bool {

  $post = curl_init ( ) ;
  curl_setopt ( $post , CURLOPT_URL , $this->website_root . "/" . $this->url->path->full ) ;
  curl_setopt ( $post , CURLOPT_POST , 1 ) ;
  curl_setopt ( $post , CURLOPT_POSTFIELDS , $this->url->query->full ) ;
  curl_setopt ( $post , CURLOPT_RETURNTRANSFER, true);

  return curl_exec ( $post ) ;

 }

}

?>