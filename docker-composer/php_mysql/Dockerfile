FROM php:7.1.2-apache 
RUN apt-get update && apt-get install libmcrypt-dev -y \
	libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
	&& docker-php-ext-install pdo pdo_mysql \
	&& docker-php-ext-install mcrypt \
	&& docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
   	&& docker-php-ext-install -j$(nproc) gd
RUN a2enmod rewrite
