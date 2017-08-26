# LgHS Members

Management interface for our Hackerspace members.

## Install

  * `composer install`
  * create a mysql database
  * copy `.env.example` to `.env` and adapt to your configuration
  * `php artisan key:generate`
  * `php artisan config:cache`
  * `php artisan optimize`
  * `php artisan migrate --seed`
  * `php artisan passport:install` to create keys for Oauth
  * check that laravel can write to `storage/` and `bootstrap/cache`
  * point a web server to `public/` directory or use `php artisan serve` for dev
  * use admin credentials you defined in .env to login. Don't forget to 
    change those credentials to something different and robust.
    
    
### Nginx

Add this to your nginx config :

```
# redirect stuff to the public inner folder
location / {
   root {DOCROOT}/public;
   try_files $uri public/$uri/ /public/index.php?$query_string;
} 

# merged the stuff people suggests for laravel inside the php block
# mind the 'merge' keyword that did the trick
location ~ \.php$ { ##merge##
   fastcgi_split_path_info ^(.+\.php)(/.+)$;
   fastcgi_pass unix:/var/run/php5-fpm.sock;
   fastcgi_index index.php;
   include fastcgi_params;
   fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
   fastcgi_intercept_errors off;
   fastcgi_buffer_size 16k;
   fastcgi_buffers 4 16k;
}
```
