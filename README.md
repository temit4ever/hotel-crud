<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## How to run the project

## Backend

- create a `.env` file and change the `DB_CONNECTION=sqlite` since database used is sqlite

- Run the migration command to set up necessary databases

- Run  `php artisan import:hotels` to pull in the csv file import

- Lastly, run  `php artisan storage:link` to link the image files to the public directory

- Make sure you register to use the app.
## Frontend
- Run `npm install` and `npm run build`.

## Note
- Both frontend and backend code can be found in the backend folder
