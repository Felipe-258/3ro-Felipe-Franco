
## Installation 
Asegurate de tener tu entorno de desarrollo establecido. Para ejecutar este proyecto necesitaras
    PHP 8.1
    MySQL/MariaDB
    composer.

1. Descargar o clonar el proyecto
2. Pegar la carpeta en tu www, si tenes laragon o htdocs si usas XAMPP
3. Copiar tu propio '.env' si tenes uno, o renombrar el '.env.example' a '.env'
4. Ahora tenes que abrir la consola el directorio
5. Ejecutar:
    1. 'composer install'
    2. 'php artisan key:generate --ansi'
    3. 'php artisan migrate'
    4. 'php artisan migrate:refresh --seed'
    5. 'npm install'
    6. 'npm run dev'
    7. 'php dumpautoload'
    8. 'php artisan optimize'
6. Ahora solo queda ejecutar el 'php artisan serve'
7. El sistema se iniciaria en 'http://127.0.0.1:8000/'
