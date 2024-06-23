# Install mysqli
FROM php:apache
RUN docker-php-ext-install mysqli &&  docker-php-ext-enable mysqli

# Restart Apache
RUN service apache2 restart


# FROM php:7-apache
# RUN apt-get update && apt-get install -y \
#   && docker-php-ext-install mysqli && docker-php-ext-enable mysqli \
#   && docker-php-ext-install pdo pdo_mysql

# FROM mysql:latest
# ENV MYSQL_ROOT_PASSWORD root
# COPY ./schemapath/privileges.sql /docker-entrypoint-initdb.d/

# FROM php:8.2-apache
# RUN pecl install redis && docker-php-ext-enable redis
# RUN docker-php-ext-install mysqli &&  docker-php-ext-enable mysqli
# # RUN docker-php-ext-install pdo pdo_mysql
# RUN a2enmod rewrite

# # Restart Apache
# RUN service apache2 restart

# FROM php:7.4-apache
# RUN docker-php-ext-install mysqli