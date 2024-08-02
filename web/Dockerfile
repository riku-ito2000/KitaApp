FROM php:8.2-apache

RUN apt-get update -y
RUN apt-get install -y zip unzip vim libonig-dev libzip-dev

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql zip

# Install npm & NodeJs
RUN apt-get install -y npm && \
    npm cache clean --force && \
    npm install n -g && \
    n 19.4 && \
    # Remove old "nodejs, npm" installed first to avoid confusing.
    apt-get purge -y nodejs npm && \
    apt-get clean

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Change DOCUMENT_ROOT
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf

# Enable rewrite_mod.
RUN a2enmod rewrite