<p align="center"><a href="https://corti.top" target="_blank"><h1>Corti.top</h1></a></p>

### Instalación y Configuración Local:

1. Clona el repositorio 
2. Instala las dependencias: `composer install`
3. Copia el archivo de configuración `.env.example` a `.env` y configura las variables de entorno, incluyendo la conexión a la base de datos.
4. Genera la clave de aplicación: `php artisan key:generate`
5. Ejecuta las migraciones de la base de datos: `php artisan migrate`
6. Inicia el servidor local: `php artisan serve`

🚨 El migrate no inserta registros de prueba asi que en principio la tabla estará limpia y no se mostrará nada en el front. Pero mediante las pruebas unitarias puedes agregar nuevos registros o directamente desde una prueba simple en el front. 

### Despliegue en Producción (Forge Laravel):

🚨 Yo he usado Forge Laravel para el despligue en produción asi que si usas esta herramienta, solo debes clonar el sitio y automáticamente hará la magia, de lo contrario:

1. Clona el repositorio 
2. Instala las dependencias: `composer install`
3. Copia el archivo de configuración `.env.example` a `.env` y configura las variables de entorno, incluyendo la conexión a la base de datos.
4. Genera la clave de aplicación: `php artisan key:generate`
5. Ejecuta las migraciones de la base de datos: `php artisan migrate`
6. Inicia el servidor local: `php artisan serve`

## Pruebas unitarias

Puedes validar las pruebas ejecutando el comando: php artisan test
Y puedes agregar nuevas pruebas ejecutando: php artisan make:test <NombreDeTuPrueba> --unit
