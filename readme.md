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
    
    
## Run

Run `php artisan serve` to run locally.

## Test

`./vendor/bin/phpunit` to run tests.

`./vendor/bin/phpunit-watcher watch` to run tests each
time a file is saved.

`./vendor/bin/phpunit --filter=MyTest` to run a single test 
(also works for phpunit-watcher).

## Other
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

### Migrating mysql to postgresql

If you are using an old database, you can use [pgloader](http://pgloader.io/) to migrate it to postgres.

First things first, install postgresql and create a database and a user.

```sql
create database lghs_members;
create user lghs_members_root with password '<password>';
grant all on database lghs_members to lghs_members_root;
```

Then run the below script using pgloader.

```lisp
load database
     from mysql://<user>:<password>@localhost/lghs-sign-in
     into pgsql://lghs_members_root:<password>@localhost/lghs_members
-- FIXME translate sequences
 WITH include drop, create tables, no truncate,
      create indexes, reset sequences, foreign keys

 SET maintenance_work_mem to '128MB', work_mem to '12MB', search_path to '"lghs-sign-in", public'

 CAST type datetime to timestamp
                drop default drop not null using zero-dates-to-null,
      type timestamp to timestamp
                drop default drop not null using zero-dates-to-null,
      type date drop not null drop default using zero-dates-to-null,
      type tinyint to boolean drop typemod using tinyint-to-boolean

 ALTER SCHEMA 'lghs-sign-in' RENAME TO 'public'
;
```

After the migration, make sure your the schema imported is correctly named public.
To do so, open a psql console (`psql lghs_members`) and type `\dn`.

If you have two schemas:
```sql
drop schema public;
alter schema <name> rename to public;
```
