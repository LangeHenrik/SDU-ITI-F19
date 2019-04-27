FROM php:7.3
RUN docker-php-ext-install pdo pdo_mysql
ENTRYPOINT ["php", "-t", "/var/www/html"]
CMD ["-S", "0.0.0.0:8080"]
