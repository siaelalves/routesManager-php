<?php
namespace routes ;

/**
 * Esta classe é responsável por manusear os segmentos de uma Url. Essa porção compreende 
 * tudo que está entre o nome do domínio até o slug. Não inclui os argumentos de URL. Para obter 
 * e manusear os argumentos de URL, utilize a classe `routes\query`.
 * 
 * @author Siael Alves
 * @copyright (c) Copyright 2024, Siael Alves
 * @link Documentação: https://siaelalves.notion.site/path-7af5ea9684944a62a581f592bf112a90?pvs=4
 */
class path {
 
 /** @var string Caminho da Url completo sem incluir a barra inicial. */
 public $full;

 /** @var array Array de strings em que cada elemento representa uma parte de um caminho de Url dividido pela barra "/". */
 public array $parts = [];

 /** @var string String que representa a última parte de uma Url. */
 public string $slug;

 /** @var string String que representa a penúltima parte de uma Url. */
 public string $previous_last;

 /** @var int Integer que representa a quantidade de partes que há na Url. */
 public int $lenght;

 /**
  * Inicialização o módulo path.
  */
 public function __construct( $url_path ) {

  $this->full = $url_path ;
  
  $this->parts = explode ( "/" , $url_path ) ;
  
  $this->lenght = count ( $this->parts ) ;

  $this->slug = $this->slice ( $this->lenght - 1 , 1 ) ;

  $this->previous_last = $this->slice ( $this->lenght - 2 , 1 ) ;
  
 }

 /**
  * Retorna uma parte do caminho de uma URL. Pode 1 ou vários segmentos, desde que 
  * sejam consecutivos.
  * @param int $offset Início da contagem. Índice do qual deseja iniciar a contagem. 
  * @param int $count Quantidade de segmentos a retornar. 
  * @return string Retorna uma string com a parte da URL desejada. Se o início da 
  * contagem for maior do que o número de segmentos da URL, ou se a quantidade de 
  * segmentos disponíveis for menor do que a quantidade desejada, retorna uma 
  * string vazia (""), sem erros.
  *
  * @example # Exemplo: Como extrair apenas as 2 primeiras partes de um caminho
  * ```
  * $url = new url("https://diariocode.com.br/blog/php/como-ler-arquivos-json-em-php"); 
  * $url->path->parts = [ "blog" , "php" , "como-ler-arquivos-json-em-php" ];
  * $urlCategory = $url->path->slice(2, 0); 
  * echo $urlCategory; 
  * ```
  * **Vai retornar:**
  * `"blog/php"`
  * @link Documentação: https://siaelalves.notion.site/slice-8de46e023f4d44b78bd29101fe0b628c?pvs=4
  */
 public function slice ( int $offset = 0 , int $count = 1 ) : string {

  $segments = array_slice ( $this->parts , $offset , $count ) ;

  $new_path = implode ( "/" , $segments ) ;

  return $new_path ;

 }
 
}