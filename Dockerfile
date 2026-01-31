FROM php:8.3-fpm-alpine AS base

RUN apk add --no-cache $PHPIZE_DEPS autoconf g++ make

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

FROM base AS development

RUN pecl install xdebug && docker-php-ext-enable xdebug

USER www-data

CMD ["php-fpm"]

FROM base AS production

COPY --chown=www-data:www-data . /app
RUN composer install --no-dev --optimize-autoloader

USER www-data

CMD ["php-fpm"]
