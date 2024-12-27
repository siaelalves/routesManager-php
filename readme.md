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
    * **REQUEST_METHOD [ enum:string ]**

    * **request [ classe ]**
        * PROPRIEDADES
            * http_host [ propriedade:string ]
            * protocol [ propriedade:string ]
            * header [ propriedade:header ]
            * request_uri [ propriedade:string ]
            * request_method [ propriedade:string ]
            * body_content [ propriedade:string ]
            * website_root [ propriedade:string ]
            * url [ propriedade:url ]
        * MÉTODOS
            * get_protocol ( )
            * get_website_address ( )
            * get ( )
            * post ( )

    * **url [ classe ]**
        * PROPRIEDADES
            * full [ propriedade:string ]
            * host [ propriedade:string ]
            * port [ propriedade:string ]
            * query [ propriedade:query ]
            * pass [ propriedade:string ]
            * user [ propriedade:string ]
            * fragment [ propriedade:string ]
            * protocol [ propriedade:string ]
            * path [ propriedade:path ]
        * MÉTODOS
            * *Não possui métodos*

    * **query [ classe ]**
        * PROPRIEDADES
            * full [ propriedade:string ]
            * parameters [ propriedade:array ]
            * keys [ propriedade:array ]
            * values [ propriedade:array ]
        * MÉTODOS
            * *Não possui métodos*

    * **path [ classe ]**
        * PROPRIEDADES
            * full [ propriedade:string ]
            * parts [ propriedade:array ]
            * slug [ propriedade:string ]
            * previous_last [ propriedade:string ]
            * lenght [ propriedade:int ]
        * MÉTODOS
            * slice ( )

    * **header [ classe ]**
        * PROPRIEDADES
            * url [ propriedade:url ]
            * response [ propriedade:int ]
            * server [ propriedade:int ]
            * date [ propriedade:DateTime ]
            * content_type [ propriedade:content_type ]
            * transfer_encoding [ propriedade:string ]
            * connection [ propriedade:string ]
            * last_modified [ propriedade:string ]
            * e_tag [ propriedade:string ]
            * lenght [ propriedade:int ]
            * method [ propriedade:REQUEST_METHOD ]
            * body [ propriedade:string ]
        * MÉTODOS
            * get_method ( )

    * **mime [ classe ]**
        * PROPRIEDADES
            * type [ propriedade:string ]
            * sub_type [ propriedade:string ]
            * full [ propriedade:string ]
        * MÉTODOS
            * *Não possui métodos*       

    * **content_type [ classe ]**
        * PROPRIEDADES
            * mime [ propriedade:mime ]
            * encoding [ propriedade:string ]
            * full [ propriedade:string ]
        * MÉTODOS
            * *Não possui métodos*

    * **http_version [ classe ]**
        * PROPRIEDADES
            * protocol [ propriedade:string ]
            * version [ propriedade:string ]
            * full [ propriedade:string ]
        * MÉTODOS
            * *Não possui métodos*

    * **http_response [ classe ]**
        * PROPRIEDADES
            * http_version [ propriedade:http_version ]
            * status_code [ propriedade:int ]
            * reason [ propriedade:string ]
            * full [ propriedade:string ]
        * MÉTODOS
            * *Não possui métodos*

    * **api [ classe ]**
        * Esta classe será removida em breve. Por isso, a lista de seus métodos e propriedades não serão documentadas.