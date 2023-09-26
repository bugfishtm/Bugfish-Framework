FROM php:8.2.6-apache
RUN apt update -y
RUN apt install curl -y
RUN apt install libapache2-mod-xsendfile -y
RUN apt install libcurl4-openssl-dev -y
RUN docker-php-ext-install mysqli && docker-php-ext-install curl
RUN a2enmod rewrite && a2enmod headers && a2enmod xsendfile && a2enmod remoteip && service apache2 restart