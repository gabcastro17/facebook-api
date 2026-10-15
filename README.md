# Facebook API

API REST desarrollada con Laravel para gestionar publicaciones, comentarios, likes e imágenes.

## Funcionalidades

- Crear publicaciones.
- Listar todas las publicaciones.
- Consultar una publicación específica.
- Agregar comentarios a una publicación.
- Dar like a una publicación.
- Eliminar publicaciones.
- Subir imágenes asociadas a las publicaciones.

## Tecnologías utilizadas

- PHP
- Laravel
- SQLite
- Laravel Sanctum
- Postman

## Requisitos previos

- PHP y Composer instalados.
- SQLite habilitado en PHP.
- Un entorno compatible con Laravel.

## Instalación

1. Clonar el repositorio:

   ```bash
   git clone https://github.com/gabcastro17/facebook-api.git
   ```

2. Entrar a la carpeta del proyecto:

   ```bash
   cd facebook-api
   ```

3. Instalar las dependencias:

   ```bash
   composer install
   ```

4. Crear el archivo de configuración del entorno:

   ```bash
   cp .env.example .env
   ```

5. Generar la clave de la aplicación:

   ```bash
   php artisan key:generate
   ```

6. Configurar en el archivo `.env` las credenciales de la base de datos MySQL y crear la base de datos correspondiente.

7. Ejecutar las migraciones:

   ```bash
   php artisan migrate
   ```

8. Crear el enlace para acceder a las imágenes almacenadas:

   ```bash
   php artisan storage:link
   ```

9. Iniciar el servidor local:

   ```bash
   php artisan serve
   ```

La API estará disponible en `http://127.0.0.1:8000`.

## Endpoints

| Método | Endpoint | Descripción |
|---|---|---|
| GET | `/api/posts` | Listar publicaciones |
| POST | `/api/posts` | Crear una publicación |
| GET | `/api/posts/{post}` | Consultar una publicación |
| POST | `/api/posts/{post}/comments` | Agregar un comentario |
| POST | `/api/posts/{post}/like` | Dar like a una publicación |
| DELETE | `/api/posts/{post}` | Eliminar una publicación |

## Pruebas con Postman

La colección exportada para probar los endpoints se encuentra en el archivo `FacebookAPI-postman_collection.json`, incluido en este repositorio.

Para utilizarla, importa el archivo en Postman y asegúrate de que el servidor Laravel esté ejecutándose.

## Repositorio

https://github.com/gabcastro17/facebook-api
