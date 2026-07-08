# COMERSELEC

Sistema web desarrollado como trabajo universitario para la gestión de catálogo, productos, categorías, marcas, proveedores, inventario, usuarios y mensajes de contacto de la empresa ficticia COMERSELEC S.A.

## Propósito

Este proyecto fue elaborado con fines académicos para demostrar el uso de:

- PHP nativo
- MySQL
- Arquitectura MVC básica
- Formularios CRUD
- Autenticación de usuarios
- Despliegue en hosting compartido

## Estructura del proyecto

- `app/`: controladores, modelos, vistas y configuración
- `public/`: archivos públicos, estilos, scripts y front controller
- `database/`: scripts SQL de instalación y datos de prueba
- `index.php`: entrada principal del sitio

## Despliegue

El proyecto está preparado para ejecutarse en un hosting compartido como InfinityFree.

### Archivos principales

- `index.php` en la raíz
- `app/`
- `public/`
- `database/`

### Base de datos

Importa el archivo `database/database.sql` en MySQL y configura las credenciales en `app/config/conexion.php` o mediante variables de entorno.

## Acceso

- Catálogo público: `/?url=catalogo`
- Inicio de sesión administrativo: `/?url=admin/login`

## Nota académica

Este proyecto es un trabajo universitario y no representa un sistema comercial en producción. Puede requerir ajustes adicionales según el entorno de hosting y la configuración de base de datos.
