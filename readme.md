# LgHS Members

Management interface for our Hackerspace members.

## Install

  * `composer install`
  * create a mysql database
  * copy `.env.example` to `.env` and adapt to your configuration
  * `php artisan migrate`
  * `php artisan passport:install` to create keys for Oauth
  * check that laravel can write to `storage/` and `bootstrap/cache`
  * point a web server to `public/` directory or use `php artisan serve` for dev
  * **use admin credentials to login and change username and password.**