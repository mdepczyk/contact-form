FROM php:7.4-fpm

RUN apt-get -y update \
&& apt-get install -y wait-for-it zip git libicu-dev librabbitmq-dev libssh-dev\
&& docker-php-ext-configure intl \
&& docker-php-ext-install intl pdo_mysql bcmath sockets \
&& pecl install amqp \
&& docker-php-ext-enable amqp

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY php.ini /usr/local/etc/php/

WORKDIR /var/www

COPY start.sh /opt/docker/
RUN chmod +x /opt/docker/start.sh
CMD ["/opt/docker/start.sh"]
