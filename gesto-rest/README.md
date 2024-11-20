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
Creedenciales para probar aplicacion:  
__user admin:__ melissa@restaurante.com   
__password:__ admin

## Importante
Lo primero es crear un espacio de trabajo, por ejemplo "Interior" donde eliges las filas y columnas del grid que simula un mapa.  
Después añades las mesas según la distribución de tu restaurante y después ya puedes realizar reservas sin problema.