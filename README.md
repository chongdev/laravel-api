# LARAVEL API & by chongdev 

## Run steps
- Clone GitHub repo for this project locally
- Run command `composer install`
- Copy .env.example -> .env and  update environments value
- Run command `php artisan key:generate`
- Run command `php artisan migrate` // In the .env file, add database information to allow Laravel to connect to the database
- Run command `php artisan db:seed`
- Run command `php artisan storage:link`
- Run command `php artisan serve` and open `http://127.0.0.1:8000` on browser

- Run command `npm install --save`
- Run command `npm run dep`