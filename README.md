## API VipCommerce

API Desenvolvida em Laravel com o propósito de ser consumida por uma aplicação front-end voltada a e-commerce. 

### Requerimentos
* php: ^7.3
* ext-mbstring
* ext-sqlite3
* ext-dom

### Comandos

```shell
composer install
cp .env.example .env
php artisan key:generate

# criação de banco para executar os testes caso esteja em ambiente de desenvolvimento
touch database/test.sqlite

# antes de passar para o próximo comando, realize as devidas configurações do projeto no arquivo .env

# caso esteja em ambiente de desenvolvimento, você poderá passar "--seed" para criar as factories
php artisan migrate
```

### Documentação Postman

https://documenter.getpostman.com/view/15544534/TzJycvz4
