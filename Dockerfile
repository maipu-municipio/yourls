FROM php:8.3-apache

RUN apt-get update && apt-get install -y --no-install-recommends \
        curl \
        libzip-dev \
        unzip \
        gnupg \
    && docker-php-ext-install pdo pdo_mysql mysqli bcmath \
    && a2enmod rewrite headers \
    && apt-get purge -y --auto-remove gnupg \
    && rm -rf /var/lib/apt/lists/*

# YOURLS routes everything through yourls-loader.php; AllowOverride so .htaccess (generated on install) works
RUN sed -ri 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

WORKDIR /var/www/html

COPY . /var/www/html
COPY docker/config.docker.php /usr/local/etc/yourls/config.docker.php
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh

RUN chmod +x /usr/local/bin/entrypoint.sh \
    && chown -R www-data:www-data /var/www/html

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["apache2-foreground"]
