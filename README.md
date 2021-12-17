# Web Programming
### OS1 - 2112 - TICA - TK2-W4-S5-R0

## Aplikasi Pendataan Produk - Team 2

<br>

| Email | Password |
| ---- | --- |
| binus@binus.edu | binustk2 |

<br>

```bash
$ docker run --rm --interactive --tty --volume "$PWD":/app composer create-project --prefer-dist laravel/laravel TK1-W3-S4-R0
$ cd TK1-W3-S4-R0/
$ docker run --rm --interactive --tty --volume "$PWD":/app composer require laravel/breeze --dev
$ docker run -v "$PWD":/usr/src/app -w /usr/src/app node npm --loglevel=info install
$ docker run -v "$PWD":/usr/src/app -w /usr/src/app node npm --loglevel=info run dev
```

<br>

```bash
$ docker network create mysql-net
$ docker run --network mysql-net --name mysql -e MYSQL_ROOT_PASSWORD=binus -e MYSQL_DATABASE=tk1 -e MYSQL_USER=binus -e MYSQL_PASSWORD=binus -p 3306:3306 -d mysql:latest

$ docker run --network mysql-net -it --rm mysql mysql -hmysql -ubinus -p

$ docker inspect mysql | grep IPAddress
```

<br>

```ini
DB_CONNECTION=mysql
DB_HOST=172.18.0.2
DB_PORT=3306
DB_DATABASE=tk2
DB_USERNAME=binus
DB_PASSWORD=binus
```

<br>

```bash
$ docker run --network mysql-net -it --rm -v "$PWD":/app -p 8000:8000 php bash
root@f154926725ba:/# cd /app/
root@f154926725ba:/app# docker-php-ext-install mysqli pdo pdo_mysql
root@f154926725ba:/app# php artisan make:controller ProductController
root@f154926725ba:/app# php artisan make:controller UserController
root@f154926725ba:/app# php artisan make:migration product       
root@f154926725ba:/app# php artisan make:migration user   
root@f154926725ba:/app# php artisan migrate
root@f154926725ba:/app# php artisan serve --host 0.0.0.0
```
