# Install mysqli
FROM php:apache
RUN apt-get update
RUN apt-get install nano -y
RUN docker-php-ext-install mysqli &&  docker-php-ext-enable mysqli

# Restart Apache
RUN service apache2 restart