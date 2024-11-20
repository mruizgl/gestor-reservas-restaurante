## Gesto-Rest - Como usarlo

Lo primero de todo ejecutamos
```php
composer install
```
Después configuramos nuestro .env con mysql y sqlite de respaldo y en .env.testing nuestro entorno de testing con my sql por ejemplo
```php
php artisan migrate
```
Lanzamos seeder para tener los dos primeros admin para gestionar la app
```php
php artisan db:seed --class=UsersTableSeeder
```
Y ya podemos utilizar nuestra app lanzando
```
php artisan serve
```    
  
  Utilidades:  
```php
# php artisan db:seed --class=UsersTableSeeder  
# php artisan backup:sqlite  
# php artisan migrate --database=sqlite  
```

Creedenciales para probar aplicacion:  
__user admin:__ melissa@restaurante.com   
__password:__ admin

## Importante
Lo primero es crear un espacio de trabajo, por ejemplo "Interior" donde eliges las filas y columnas del grid que simula un mapa.  
Después añades las mesas según la distribución de tu restaurante y después ya puedes realizar reservas sin problema.