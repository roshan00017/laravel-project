


Clone the repository

    git clone https://gitlab.com/roshan00017/laravel-project.git

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


## migration all & db seed command
php artisan migrate:all
