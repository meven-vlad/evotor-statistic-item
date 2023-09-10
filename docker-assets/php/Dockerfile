FROM php:8.1-apache

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli && docker-php-ext-install pdo_mysql

RUN openssl dhparam -out /etc/ssl/certs/dhparam.pem 2048 &&\
    openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/ssl/private/ssl-cert-snakeoil.key -out /etc/ssl/certs/ssl-cert-snakeoil.crt \
    -subj "/C=RU/ST=Moscow/L=Kremlin/O=Azzrael Code/OU=bb.mv/CN=bb.mv"

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libzip-dev \
    libpq-dev \
    libpng-dev \
    libonig-dev \
    libxslt-dev \
    libxml2-dev

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install \
        pdo \
        pgsql \
        pdo_mysql \
        xsl \
        pdo_pgsql \
        xml \
        gd \
        opcache \
        zip \
        pcntl \
        bcmath

ENV PHPREDIS_VERSION 5.3.5

RUN mkdir -p /usr/src/php/ext/redis \
    && curl -L https://github.com/phpredis/phpredis/archive/$PHPREDIS_VERSION.tar.gz | tar xvz -C /usr/src/php/ext/redis --strip 1 \
    && echo 'redis' >> /usr/src/php-available-exts \
    && docker-php-ext-install redis

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN a2enmod rewrite && a2enmod ssl && a2enmod socache_shmcb
RUN a2ensite default-ssl

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
