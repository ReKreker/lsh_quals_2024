FROM php:8.0-fpm-alpine

# Setup user
RUN adduser -D -u 1000 -g 1000 -s /bin/sh www

# Install system packages
RUN apk add --no-cache --update supervisor nginx

# Configure php-fpm and nginx
RUN rm -f /usr/local/etc/php-fpm.d/*.conf
COPY config/fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY config/supervisord.conf /etc/supervisord.conf
COPY config/nginx.conf /etc/nginx/nginx.conf

# Copy challenge files
COPY challenge /www

WORKDIR /www

# RUN chmod og+w /www/mydb.db
RUN chown -R www:www /www

RUN mkdir -p /tmp

COPY flag.txt /flag.txt

# Setup permissions
RUN chown -R www:www /var/lib/nginx

# Expose the port nginx is listening on
EXPOSE 1337

# Copy entrypoint
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
ENTRYPOINT [ "/entrypoint.sh" ]

# Populate database and start supervisord
CMD /usr/bin/supervisord -c /etc/supervisord.conf
