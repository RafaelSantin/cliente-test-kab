
# Menu manager

## Development

projeto realizado com intuido de aprendizado e teste de entrevista. Utilizando VueJs, Laravel e docker. 

## Pre-requisitos

* Php 7.4
* Composer
* Node
* Docker
* PDO PHP
* Mbstring PHP
* MysqlDrive PHP
* BCMath PHP 
* Ctype PHP
* JSON PHP

## Getting Start

Clone o repositorio para sua maquina e acesse a pasta.

Execute os comandos

```
 composer install
```

```
 npm install
```

Para iniciar o mysql atraves do docker favor executar o seguinte comando .

```
 docker-compose up
```

Renomeie o arquivo ".env.example" para ".env"

Execute o comando

```
php artisan key:generate
```

Em outro prompt execute o comando 

```
 php artisan migrate 
```

Suba a aplicação do laravel com o comando abaixo.

```
 php artisan serve
```

execute o npm run para executar a aplicação vue.

```
 npm run dev
```
A primeira tela do sistema será a padrão do laravel com opção para fazer login/register no lado superior direito. O processo de enviar email não está configurado.

Após fazer login irá para o gerenciamento de clientes. 
