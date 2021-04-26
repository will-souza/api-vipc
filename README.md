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
```

Criação de banco para executar os testes caso esteja em ambiente de desenvolvimento
```shell
touch database/test.sqlite
```

Antes de passar para o próximo comando, realize as devidas configurações do projeto no arquivo .env

Caso esteja em ambiente de desenvolvimento, você poderá passar "--seed" para criar as factories
```shell
php artisan migrate
```
Caso esteja em ambiente de produção, existem seeds para métodos de pagamento e gêneros
```shell
php artisan db:seed --class=PaymentMethodSeeder
php artisan db:seed --class=GenderSeeder
```

### Documentação Postman

https://documenter.getpostman.com/view/15544534/TzJycvz4

### Testes
Para execução dos testes, basta executar o seguinte comando:
```shell
php artisan test
```
