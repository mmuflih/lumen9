# Friendchised Api Services

Using Lumen 9 and php 8

## Setup Project

### - Requirements
- php version >= 8.1
- mysql version 5.7

### - Clone
    git clone git@github.com:friendchised/fc-api.git

### - Composer Install
    cd fc-api
    composer install

### - Copy Environtment
    cp .env.expample .env

### - Edit Environtment
    DB_HOST=<database_host>
    DB_PORT=<database_port>
    DB_DATABASE=<database_name>
    DB_USERNAME=<database_username>
    DB_PASSWORD=<database_password>

### - Migration
    php artisan migrate

### - Config
    php artisan jwt:secret
    php artisan jwt:generate-certs
