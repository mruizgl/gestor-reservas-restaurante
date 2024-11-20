## Gesto-Rest - Como usarlo

Lo primero de todo ejecutamos
```
composer install
```
Después configuramos nuestro mysql y sqlite de respaldo en .env y ejecutamos
```
php artisan migrate
```
Lanzamos seeder para tener los dos primeros admin para gestionar la app
```
php artisan db:seed --class=UsersTableSeeder
```
Y ya podemos utilizar nuestra app lanzando
```
php artisan serve
```