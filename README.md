
# ColDevs - Prueba Técnica

Esta es una aplicación backend en PHP y Laravel que permite las operaciones CRUD en un escenario de reservas, tours y usuarios. Se rigen los lineamientos acordados en la prueba técnia.

Para iniciar la aplicación, primero deben clonar el repositorio a uno local.

OJO: La aplicación fue desarrollada con las versiones de 
- PHP 8.2
- Laravel 11.9
- Composer 2.7.7

## Instalación

Clonamos el repositorio

```bash
git clone https://github.com/SebasPCDev/laravel-technical-test.git
```

### Instalación

```bash
cd laravel-technical-test
composer install
```

Luego de tener todas las dependencias instaladas, debe crear un archivo .env replicando el mismo formato de .env.example

Los elemejos a configurar son:

En mi caso, utilicé postgreSQL.
```bash
    DB_CONNECTION=pgsql
    DB_HOST=localhost
    DB_PORT=5432
    DB_DATABASE=nombre_base_datos
    DB_USERNAME=tu_nombre_de_usuario
    DB_PASSWORDtu_contraseña
```

Luego, generar la clave de aplicación 
```bash
    php artisan key:generate
```

Finalmente, ejecutar las migraciones junto con los seeders y levantar el servidor..

```bash
    php artisan migrate:refresh --seed

    php artisan serve

```

Con esto, ya la aplicación debería levantar en el servidor.


## Ejecuión de Test

Para correr los test con phpUnit, sólo debe ejecutar el comando

```bash
  php artisan test
```
Esto automáticamente correrá los test establecidos para la aplicación.


## Soporte

Para soporte, escribir a sebpa.16@gmail.com




## Authors

- [@SebasPCDev](https://github.com/SebasPCDev)

