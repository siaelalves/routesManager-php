# Routes Manager PHP

**Objetivo** Permite manipular e obter informações relativas às requisições HTTP e URLs feitas pelo visitante do website.

## Detalhes

### O que faz?

Quando um visitante entra numa URL do seu website, o servidor deve enviar de volta para o dispositivo do visitante a informação relativa à URL fornecida. Para que isso aconteça, é necessário processar a URL.

**Processar** significa 1) identificar as partes de uma URL, 2) comparar essas partes com algum banco de dados e 3) exibir a informação equivalente registrada no banco de dados.

O **Routes Manager PHP** auxilia na *identificação das partes de uma URL* e do *tipo de requisição* que foi feita ao website. A partir daí, o desenvolvedor terá condições de devolver ao visitante a informação solicitada.

### O que não faz?

O **Routes Manager PHP** *não* possui estrutura de banco de dados pré-definida para devolver ao visitante as informações requisitadas.

## Como instalar

1. Copie o conteúdo do projeto para um diretório dentro de seu projeto;
2. Num script externo à pasta deste projeto, utilize o seguinte código para incluir **Routes Manager**:

```php
require dirname(__FILE__) . "/routesManager/routes.php" ;
```

3. Acesse as classes de **Routes Manager** através do namespace `\routes`;

## Exemplos

**1. Obter a URL acessada por um visitante**

Para obter informações relativas à URL acessada por um visitante do seu site, faça o seguinte:

```php
$request = new \routes\request();
echo $request->url->full;
```

A URL acessada pelo visitante é obtida e seu valor pode ser obtido através da classe `\routes\url`. Essa classe tem uma propriedade chamada **full** que representa a URL completa que o visitante deseja.

No exemplo acima, poderiam ser obtida outras propriedades, como:

- domínio: `$request->url->host`;
- porta: `$request->url->port`;
- protocolo: `$request->url->protocol`;
- segumentos: `$request->url->path->full`;
- argumentos de URL: `$request->query->full`;

As propriedades `path`e `query` são classes de mesmo nome. Essas classes permitem que você obtenha:

**no caso de `path`**: os segmentos separamente utilizados numa URL;
**no caso de `query`**: os argumentos separamente utilizados numa URL;

## Mapa de utilização de Routes Manager

Abaixo, está o mapa de classes e propriedades de Routes Manager. 

* routes
 * REQUEST_METHOD [ enum ]
 * request
  * http_host
  * protocol
--- header
--- request_uri
--- request_method
--- body_content
--- website_root
--- url
-- url
-- query
-- path
-- header [ possui erros ]
-- mime
-- content_type
-- http_version
-- http_response
-- api [ será descontinuado ]