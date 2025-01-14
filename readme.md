# Routes Manager PHP

**Versão** 0.3.0

**Objetivo** Permite manipular e obter informações relativas às requisições HTTP e URLs feitas pelo visitante do website.

## Detalhes

### O que faz?

Quando um visitante acessa uma URL do seu website, o servidor deve enviar de volta para o dispositivo do visitante informações relativas à requisição realizada. Para que isso aconteça, é necessário processar a URL.

O termo **"processar"** significa:
1) identificar as partes de uma URL, 
2) comparar essas partes com o conteúdo do banco de dados, e 
3) retornar para o corpo da página a informação equivalente registrada no banco de dados.

O **Routes Manager PHP** auxilia na *identificação das partes de uma URL* e do *tipo de requisição* que foi feita ao website. A partir daí, o desenvolvedor terá condições de devolver ao visitante a informação solicitada.

### O que não faz?

O **Routes Manager PHP** *não retorna* para o visitante o conteúdo e página. Também não possui realizar essa ação mediante um banco de dados.

## Como instalar

1. Copie o conteúdo para um diretório dentro de seu projeto;
2. Num script externo à pasta deste projeto, utilize o seguinte código para incluir **Routes Manager**:

```php
require dirname(__FILE__) . "/routesManagerPHP/routes.php" ;
```

3. Acesse as classes de **Routes Manager** através do namespace `\routes`;

A estrutura de diretórios do projeto deve estar da seguinte forma:

- routesManagerPHP
    - *Conteúdo de routesManagerPHP*
    - ...
- index.php

No caso, o script *index.php* deve conter a instrução no passo 2. Fique à vontade para renomear a pasta em que ficará instalado este projeto.

## Exemplos

### **1. Como obter a URL acessada por um visitante**

Para obter a URL acessada por um visitante do seu site, faça o seguinte:

```php
$request = new \routes\request();
echo $request->url->full;
```

No exemplo acima,
- `$request` representa o objeto `request` declarado na linha anterior;
- `$request->url` é uma propriedade do objeto `request` que representa o objeto `url`;
- `$request->url->full` é uma propriedade do objeto `url` que retornará uma `string` que representa a URL que o visitante está acessando;

Se desejar obter outras informações, poderia fazer o seguinte:

- domínio: `$request->url->host`;
- porta: `$request->url->port`;
- protocolo: `$request->url->protocol`;
- segumentos: `$request->url->path->full`;
- argumentos de URL: `$request->query->full`;

As propriedades `path` e `query` são de uma classe de mesmo nome que elas. Essas classes permitem que você obtenha:

**no caso de `path`**: os segmentos separamente utilizados numa URL;
**no caso de `query`**: os argumentos separamente utilizados numa URL;

## Mapa de utilização de Routes Manager

Abaixo, está o mapa de classes e propriedades de Routes Manager.

* routes
    * **REQUEST_METHOD [ enum:string ]**

    * **request [ classe ]**
        * PROPRIEDADES
            * server_address [ propriedade:string ]
            * remote_address [ propriedade:string ]
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
            * is_local_server ( )
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

    * **header [ classe ]** *(EM TESTES)*
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
        * **Esta classe ainda não foi implementada.** Ainda não possui métodos e nem propriedades.

## Bugs

Atualmente, o projeto possui os seguintes bugs:

- O objeto `header` demora muito para obter as informações de cabeçalho da página, congelando totalmente o website;

- A maioria das funções não possui tratamento de erros eficiente, expondo dados sensíveis e a própria estrutura do website;
   - Para dirimir esse bug, em versões futuras será criado a classe **Exception** para tratamento de erros;

## Atualizações

- **v0.3.0:
    - Adicionadas 2 propriedades `$server_address` e `$remote_address` à classe `request` para obter o IP do servidor e do cliente que está requisitando dados.
    
    - Adicionado novo método `is_local_server ( )` que determina se o servidor é local ou se está on-line.