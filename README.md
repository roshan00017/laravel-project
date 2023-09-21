# ![Smart Office Management System ]

# Getting started

## Installation

Clone the repository

    git clone https://gitlab.com/cstprogrammer/e-office.git

Switch to the repo folder

    cd lara-9-multi-language-cms
Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate


Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Run the database seeders

    php artisan db:seed

Create Storage Link

    php artisan storage:link

Start the local development server

    php artisan serve

Run code style format

    ./vendor/bin/pint

**TL;DR command list**

    git clone https://gitlab.com/cstprogrammer/e-office.git
    cd lara-9-multi-language-cms
    composer install
    cp .env.example .env
    php artisan key:generate
    php artisan storage:link
    ./vendor/bin/pint

**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve

## Database seeding

Run the database seeder and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh


----------

# Code overview

## Dependencies

- [user-agent](https://packagist.org/packages/jenssegers/agent) - For user agent detect
- [captcha](https://github.com/mewebstudio/captcha) - For login / register captcha

## Folders

- `app` - Contains all the Eloquent models
- `app/Http/Controllers` - Contains all the  controllers
- `app/Http/Middleware` - Contains the Roles  middleware
- `app/Http/Requests` - Contains all the api form requests
- `config` - Contains all the application configuration files
- `database/factories` - Contains the model factory for all the models
- `database/migrations` - Contains all the database migrations
- `database/seeds` - Contains the database seeder
- `routes` - Contains all the  routes defined in web.php file

## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

## migration sequence
php artisan migrate:fresh
php artisan migrate --path=/database/migrations/basicDetails
php artisan migrate --path=/database/migrations/calendar
php artisan migrate --path=/database/migrations/meetings
php artisan migrate --path=/database/migrations/edmis
php artisan migrate --path=/database/migrations/grevience
php artisan migrate --path=/database/migrations/masterSettings
php artisan migrate --path=/database/migrations/apiSettings
php artisan migrate --path=/database/migrations/tokenManagement
php artisan migrate --path=/database/migrations/notifications
php artisan migrate --path=/database/migrations/voiceCallManagement
php artisan db:seed


## migration all & db seed command
php artisan migrate:all
