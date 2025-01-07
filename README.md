## About Application

This application, is a application with real-time collaboration features, user authentication, and data persistence. The user will create a collaborative whiteboard where multiple users can join a shared workspace, draw, and interact with each other's contributions in real-time.

## Technologies

- **Laravel 10**
- **Sanctum**
- **Pusher WebSocket**
- **Pint**
- **PHP 8.4**
- **Postsgres Database**
- **Docker**

## How to start the project

1 - Access the project root folder

2 - Run the `docker-compose up -d` command

3 - After finishing the build, access the PHP container: `docker exec -it whiteboard-api-php-fpm-1`

4 - Install project dependencies `composer install`

5 - Run migrations `php artisan migrate`

6 - The project will be running on port 8000: `localhost:8000`

6 - Change .env variables
