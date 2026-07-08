# Despliegue en InfinityFree

Este proyecto ya quedó preparado para funcionar desde la raíz del hosting.

## Estructura a subir

Sube todo el contenido del proyecto al `public_html` del hosting, conservando esta estructura:

- `index.php`
- `.htaccess`
- `app/`
- `public/`
- `database/`

## Base de datos

1. Crea la base de datos en InfinityFree.
2. Importa `database/database.sql` desde phpMyAdmin.
3. Configura las credenciales de MySQL en el hosting.

## Variables de entorno

El archivo `app/config/conexion.php` lee estas variables:

- `DB_HOST`
- `DB_NAME`
- `DB_USER`
- `DB_PASSWORD`
- `DB_PORT`

Si tu hosting no permite variables de entorno, puedes dejar el archivo tal como está y adaptar los valores dentro de `app/config/conexion.php`.

## URL de acceso

- Catálogo público: `/`
- Panel admin: `/?url=admin/login`

## Nota

La aplicación usa rutas por query string, así que no necesita configurar rewrite avanzado para funcionar.
