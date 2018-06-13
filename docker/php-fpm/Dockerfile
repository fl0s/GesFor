FROM php:7.1-fpm

RUN apt-get update && apt-get install -y git unzip libxrender1 libfontconfig libxext6
ADD https://getcomposer.org/download/1.4.1/composer.phar /usr/local/bin/composer
RUN echo "abd277cc3453be980bb48cbffe9d1f7422ca1ef4bc0b7d035fda87cea4d55cbc /usr/local/bin/composer" | sha256sum -c - && chmod 755 /usr/local/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1

RUN curl -f -L "https://github.com/wkhtmltopdf/wkhtmltopdf/releases/download/0.12.4/wkhtmltox-0.12.4_linux-generic-amd64.tar.xz" | tar -x -J --strip-components=1 -C /usr/local wkhtmltox/bin

RUN apt-get update && apt-get install -y libicu-dev libpq-dev
RUN docker-php-ext-install pdo_mysql intl bcmath

COPY php.ini /usr/local/etc/php/php.ini

ARG UID=1000
RUN useradd --uid $UID app
USER app

ENV PATH="/var/www/html/vendor/bin:${PATH}"
