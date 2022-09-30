# API PEDIDO DE PRODUTOS

Este projeto consiste em sistema que realiza pedidos de produtos, onde poderá cadastrar clientes, produtos e pedidos.

* Gerenciamento de Produtos
* Gerenciamento de Clientes
* Gerenciamento de Pedidos
* Relatório

## Tecnologias Utilizadas

- PHP 7.4
- Laravel 8
- Postgres

```bash
    # Clone o repositório
    $ git clone https://github.com/kariofreire/api-pedido-de-produto.git

    # Acesse o diretório do projeto
    $ cd api-pedido-de-produto

    # Copie o arquivo .env.example e faça as configurações necessárias, banco de dados.
    $ cp .env.example .env 

    # Instale as dependências do projeto dentro do Docker
    $ composer install

    # Execute as migrations
    $ php artisan migrate

    # Gere a nova application key
    $ php artisan key:generate

    # Starta o projeto
    $ php artisan serve
```
#### Rotas da API

| Method | URI | Name |
|--------|-----|------|
| GET/HEAD | api/v1/clientes | clientes.index |
| POST | api/v1/clientes | clientes.store |
| GET/HEAD | api/v1/clientes/{id} | clientes.show |
| PUT | api/v1/clientes/{id} | clientes.update |
| DELETE | api/v1/clientes/{id} | clientes.delete |
|||
| GET/HEAD | api/v1/produtos | produtos.index |
| POST | api/v1/produtos | produtos.store |
| GET/HEAD | api/v1/produtos/{id} | produtos.show |
| PUT | api/v1/produtos/{id} | produtos.update |
| DELETE | api/v1/produtos/{id} | produtos.delete |
|||
| GET/HEAD | api/v1/pedidos | pedidos.index |
| POST | api/v1/pedidos | pedidos.store |
| GET/HEAD | api/v1/pedidos/create | pedidos.create |
| GET/HEAD | api/v1/pedidos/{id} | pedidos.show |
| PUT | api/v1/pedidos/{id} | pedidos.update |
| DELETE | api/v1/pedidos/{id} | pedidos.delete |