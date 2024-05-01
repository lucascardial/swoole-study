FROM php:8.3-cli

RUN pecl install swoole && docker-php-ext-enable swoole

COPY . /var/www/

ENTRYPOINT ["php", "/var/www/public/index.php", "start"]