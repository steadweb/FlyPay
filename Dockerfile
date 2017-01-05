FROM php:7

RUN docker-php-source extract \
&& apt-get update \
&& rm -rf /var/lib/apt/lists/* \
&& docker-php-ext-install pdo pdo_mysql \
&& docker-php-source delete

RUN pecl install xdebug-2.5.0 && docker-php-ext-enable xdebug
