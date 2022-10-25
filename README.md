#5/8/22
# Formato de Clima Organizacional para la Dirección de Desarrollo Organizacional

> Proyecto FLOSS de la Subsecretaría de Recursos Humanos del Gobierno del Estado de Sonora
Proyecto Publico para elaborar un cuestionario para revisar el Clima Organizacional del  Personal de la Dirección de Desarrollo Organizacional

## Requisitos :

Tener configurado o instalado en forma nativa o virtual en la plataforma del codigo fuente:

* PHP Ver>7.3 
> https://windows.php.net/download
  > Asegurarse que las extensiones estan activas (editar php.ini):
  extension=openssl
  extension=pdo_mysql 
  Locate the file with: 
  php -i | find/i"configuration file"  
* Composer version 2.2.4 2022-01-08 12:30:42
> https://getcomposer.org/doc/00-intro.md#installation-windows
* mariadb >10.3 | MySQL version: 5.6.34 (operando en el puerto default 3306)
> https://mariadb.org/download/?t=mariadb&p=mariadb&r=10.6.5&os=windows&cpu=x86_64&pkg=zip&m=xtom_fre

## Instalacion y configuracion
### Paso 1 .- Instalar laravel y la aplicacion web
`git clone https://github.com/cayi/clima`
`composer install --ignore-platform-req=ext-gd --ignore-platform-req=ext-fileinfo`
### Paso 2 .- Configuracion con el DBMS:
 copiar el archivo '.env.example' como '.env'
 editar el archivo .env con las credenciales del servidor SQL:
 DB_DATABASE=clima_db
 DB_USERNAME=root
 DB_PASSWORD=usbw
### Paso 3 .-  Crear la base de datos **clima_db** dentro del gestor

### Paso 4 .-  Ejecutar la migracion y los datos iniciales (seeders)
`php artisan migrate:fresh --seed`

### Paso 5 .-  Generar llave de la app
`php artisan key:generate`

## Ejecutar la aplicacion web de forma local
### Paso 1.- Iniciar el servidor web de laravel:
`php artisan serve`
Hacer click en la siguiente URL
[http://127.0.0.1:8000](http://127.0.0.1:8000)

### Paso 2
Hacer click en la siguiente URL de acceso
[http://127.0.0.1:8000/login](http://127.0.0.1:8000/login)

### Paso 3 : teclear credenciales de administrador
admin@gmail.com
admin

## Notas adicionales
Se intenta utilizar las mejores practicas como son:

 Priebas unitarias (en desarrollo)
 Controles flacos (Skinny controllers)
 Uso de Repositorios
 Uso de Modelos
 Importacion y Exportacion de Datos con hojas de Excel
 

  Es un proyecto EN DESARROLLO, algunas opciones aun no funcionan
 para ingresar usuario admin@gmail.com contraseña admin
 NO usar giones bajos en los nombres de las tablas
 USAR la letra s al final de los nombres de las tablas (probar)
 NO usar mayusculas entre medio de los nombres de Repositorios o Modelos
usar MAYUSCULAS a la hora de importar formatos Climas, quitar los acentos
en lasl columnas dep_o_ent, unidad_admva y area, ya que habrá problemas en los filtrox

pra subir a la nube
git add .
git commit -m "modif_20210507"
git push

Video de YOUTUBE del CRUD Laravel 8, ejemplo de EMpleados con Foto que sube a storage public/uploads
https://www.youtube.com/watch?v=9DU7WLZeam8

para ver rutas actvas
php artisan route:list

Le da un migrate:reset (drop all tables)
y crea las migraciones (php artisan migrate)
php artisan migrate:fresh

Genera los registros de Usuario Administrador y uno de prueba
php artisan db:seed



///////////////////////////////////////////////////////////////////
Pasos para subir una APP de LARAVEL con HTTP o HTTPS a HEROKU 23/6/2022
////////////////////////////////////////////////////////////////
1. instalar HEROKU, aqui la instruccion para Windows:
	descargar https://cli-assets.heroku.com/heroku-x64.exe e instalar
si tienes mac la instruccion es:
	brew install heroku/brew/heroku
si tienes ubuntu:
	curl https://cli-assets.heroku.com/install-ubuntu.sh | sh
si tienes npm:  (no lo recomienda)
	npm install -g heroku
Verifica que quedo instalado con:
heroku --version
2. crea al proyecto local con el comando:
composer create-project laravel/laravel herokularavel --prefer-dist
NOTA: omite el paso anterior si ya tienes el proyecto, pero en este caso borra la carpeta .git
3. Dentro de la carpeta del proyecto de laravel debes tener el archivo Procfile. con el contenido:
web: vendor/bin/heroku-php-apache2 public/
4. Inicializa el proyecto con:
git init
5. Entra a Heroku desde la terminal
heroku login
NOTA: usa un correo diferente y una cuenta Heroku diferente para cada APP ya que solo da una 
base de datos gratis por cuenta
6. Crea la aplicacion Heroku
heroku create nombre  
NOTA: De preferencia el mismo nombre del proyecto local, si existe eliminalo primero
 desde la pagina de heroku con el login correcto
7.  Genera la llave de la APP de LARAVEL con:
php artisan key:generate --show
8. Agrega la llave a las variables de entonrno de Heroku con:
heroku config:set APP_KEY='llave generada en el paso 7'
9. Sube los cambios a Heroku
git add .
git commit -m "primera entrega de laravel a heroku"
git push heroku master
NOTA: te pone un rollo subiendo el proyecto a Heroku
Inicia la aplicacion con:
heroku open
NOTA: si la aplicación tiene HTTPS marcara error ERR_TOO_MANY_REDIRECTS
10. Configura la base de Datos en Heroku, primero agrega la base de datos con:
heroku addons:create heroku-postgresql:hobby-dev
El comando anterior agrega una variable de entorno, para verlas dar:
heroku config
debe mostrar las variables APP_KEY y DATABASE_URL
Abre el archivo database.php que esta en la carpeta config de tu proyecto
cambia la linea siguiente 'mysql' por 'pgsql'
'default' => env('DB_CONNECTION', 'pgsql'),
Agrega al inicio del archivo a linea:
$DATABASE_URL=parse_url('el valor de DATABASE_URL aqui');
comenta con /*  */ todo el bloque que inicia con 'pgsql' => [
En ese lugar agrega el bloque siguiente:
'pgsql' => [
            'driver' => 'pgsql',
            'host' => $DATABASE_URL["host"],
            'port' => $DATABASE_URL["port"],
            'database' => ltrim($DATABASE_URL["path"], "/"),
            'username' => $DATABASE_URL["user"],
            'password' => $DATABASE_URL["pass"],
            'charset' => 'utf8',
            'prefix' => '',
            'schema' => 'public',
            'sslmode' => 'require',
        ],
Agrega una variable mas a Heroku con el comando:
heroku config:add DB_CONNECTION=pgsql
NOTA: en este momento tendras 3 variables APP_KEY, DATABASE_URL, DB_CONNECTION
verifica con el comando heroku config
11. Si tu app esta para trabajar en HTTPS, debes de:
a) En el archivo AppServiceProvider.php de la ruta proyecto/app/Providers
agregar al inicio la linea:
use Illuminate\Support\Facades\URL;
y dentro de la función  public function boot():
	URL::forceScheme('https');
b) En el archivo .htaccess de proyecto/public comentar con un # las lineas:
    #RewriteCond %{HTTPS} !=on
    #RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
12. Agrega los cambios a Heroku
git add .
git commit -m "ya con la base de datos postgres"
git push heroku branch:master  o 
git push heroku master 
Corre las migraciones con:
heroku run php artisan migrate -seed
NOTA: confirma con 'yes' ya que estas en produccion



Proyecto Original aqui:
[Click Here](https://radiant-earth-84938.herokuapp.com)

## heroku CLI to go the bash

$heroku git:remote -a clima
heroku run bash
php artisan migrate:refresh  
php artisan db:seed 

Para instalarlo con docker seguir este tutorial
https://www.digitalocean.com/community/tutorials/how-to-set-up-laravel-nginx-and-mysql-with-docker-compose-on-ubuntu-20-04

otro tutorial!
https://www.cloudsigma.com/deploying-laravel-nginx-and-mysql-with-docker-compose/
me quedo atordo en docker-compose exec app bash php artisan migrate:fresh --seed

otro tutorial
https://github.com/aschmelyun/docker-compose-laravel
