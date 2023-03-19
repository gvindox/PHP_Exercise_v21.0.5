FROM composer AS composer
FROM php:8.2-fpm

ARG LOCAL_UID=${LOCAL_UID}

# Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# apt-get
RUN apt-get update && apt-get -y --no-install-recommends install  \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    librabbitmq-dev \
    && rm -rf /var/lib/apt/lists/*

# php ext
RUN docker-php-ext-configure intl && docker-php-ext-install \
    pgsql \
    pdo_pgsql \
    zip \
    intl

# xdebug
RUN pecl install xdebug amqp && docker-php-ext-enable xdebug amqp

# override UID exists user
RUN usermod -u ${LOCAL_UID} www-data && groupmod -g ${LOCAL_UID} www-data

RUN chown -R www-data:www-data /var/www

USER www-data

CMD ["php-fpm"]
