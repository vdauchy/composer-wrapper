FROM php:7.4-cli-alpine

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/
COPY --from=composer:1.10 /usr/bin/composer /usr/bin/composer
COPY . .

RUN apk add \
    git

RUN install-php-extensions \
    pcov \
    ast \
    zip

WORKDIR /usr/src/app