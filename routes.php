<?php
/**
 * Inicializador do namespace `routes`.
 * Organiza classes e funções que manipulam Url e requisições do usuário.
 * Não altere a ordem em que os arquivos são incluídos. Todas as classes 
 * inseridas abaixo fazem parte deste namespace.
 * 
 * @author Siael Alves
 * @copyright (c) Copyright 2024, Siael Alves
 * @link Indisponível
 */
namespace routes ;

// ------------------ //

/**
 * Enumerador REQUEST_METHOD:
 * Lista de métodos de requisição HTTP.
 */
require dirname(__FILE__) . "/REQUEST_METHOD.php" ;

// ------------------ //

/**
 * Classe `mime`:
 * Manipula tipos de conteúdo da página Web.
 */
require dirname(__FILE__) . "/mime.php" ;

/**
 * Classe `content_type`:
 * Manipula tipos de conteúdo da página Web.
 */
require dirname(__FILE__) . "/content_type.php" ;

/**
 * Classe `http_version`:
 * Dá acesso a versões do protocolo HTTP identificados no 
 * cabeçalho da página Web.
 */
require dirname(__FILE__) . "/http_version.php" ;

/**
 * Classe `http_response`:
 * Manipula respostas HTTP.
 */
require dirname(__FILE__) . "/http_response.php" ;

/**
 * Classe `header`:
 * Manipula cabeçalhos HTTP. Necessita das classes 
 * `mime`, `content_type`, `http_version` e `http_response`.
 */
require dirname(__FILE__) . "/header.php" ;

// ------------------ //

/**
 * Classe `request`:
 * Manipula requisições HTTP.
 */
require dirname(__FILE__) . "/request.php" ;

// ------------------ //

/**
 * Classe `url`:
 * Manipula Urls.
 */
require dirname(__FILE__) . "/url.php" ;

/**
 * Classe `query`:
 * Manipula argumentos de Url. Necessita da classe `url`.
 */
require dirname(__FILE__) . "/query.php" ;

/**
 * Classe `path`:
 * Manipula caminhos de Url. Necessita da classe `url`.
 */
require dirname(__FILE__) . "/path.php" ;

// ------------------ //

/**
 * Namespace `api`:
 * Manipula requisições de API específicas. Atualmente, 
 * a utilização parcial das APIs para Youtube e Threads. 
 * Em breve, será substituída por uma namespace genérica 
 * e mais eficiente.
 */
require dirname(__FILE__) . "/api.php" ;

// ------------------ //

/**
 * @var \routes\api\youtube\channel Objeto 
 * `my_youtube_channel` representa o canal do Youtube 
 * "Diário Code" e permite acessar determinadas 
 * informações do canal.
 */
$my_youtube_channel = new \routes\api\youtube\channel ( api\youtube\KEYS::CHANNEL_ID->value , "diariocode" , "Diário Code" , new \routes\url ( "https://youtube.com/@diariocode" ) ) ;

/**
 * @var \routes\api\threads\user Objeto `my_threads_account` 
 * permite acessar determinadas informações da conta do 
 * usuário `Diário Code` da rede social `Threads`.
 */
$my_threads_account = new \routes\api\threads\user ( ) ;

// ------------------ //