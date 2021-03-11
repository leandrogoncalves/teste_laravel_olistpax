FROM php:7.4-fpm-alpine
RUN apk add --update \
    openssl \
    bash \
    mysql-client \
    nodejs \
    npm \
    pkgconfig \
    libzip-dev \
    libcurl \
    curl-dev \
    curl \
    vim \
    wget \
    zip \
    unzip \
     && rm -rf /var/cache/apk/*
RUN docker-php-ext-install pdo pdo_mysql curl bcmath

WORKDIR /var/www

RUN rm -rf /var/www/html
RUN ln -s public html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 9000
ENTRYPOINT [ "php-fpm" ]
