FROM php:7.2-fpm

RUN apt-get update -y && apt-get install --yes --no-install-recommends \
    libssl-dev

RUN apt-get install -y libpng-dev zlib1g-dev libxml2-dev git


# Install bcmath
RUN docker-php-ext-install bcmath

# Install mbstring
RUN docker-php-ext-install mbstring

RUN docker-php-ext-install zip

# Install GD
RUN docker-php-ext-install gd

# Install xmlrpc
RUN docker-php-ext-install xmlrpc

# Install sockets
RUN docker-php-ext-install sockets

# Install postgre
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv ./composer.phar /usr/local/bin/composer
