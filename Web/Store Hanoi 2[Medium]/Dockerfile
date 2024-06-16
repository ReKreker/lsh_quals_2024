FROM php:8.0-fpm-alpine

# Get dependencies
RUN apk add nginx sqlite-dev supervisor && \
  adduser -D www

RUN docker-php-ext-install pdo pdo_sqlite

# Configure packages
COPY config/fpm.conf /usr/local/etc/php-fpm.conf
COPY config/supervisord.conf /etc/supervisord.conf
COPY config/nginx.conf /etc/nginx/nginx.conf

WORKDIR /www

# Copy challenge files
COPY challenge /www

# Copy flag
COPY flag.txt /flag.txt

# Setup permissions
RUN chown -R www:www /www /var/lib/nginx

EXPOSE 1337

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]

