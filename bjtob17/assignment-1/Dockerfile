FROM php:7.3
RUN docker-php-ext-install pdo pdo_mysql
CMD ["php", "-S", "0.0.0.0:80", "-t", "/var/www/html"]