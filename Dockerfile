FROM php:8.3-fpm

WORKDIR /var/www

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && sync && install-php-extensions mbstring pdo_mysql zip exif pcntl gd intl redis

COPY . /var/www

## Update system repository and install php extensions
RUN apt-get update && apt-get install -y libfreetype-dev procps systemctl nano lsof

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

## Install Composer globally \
#RUN curl -sLS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer
RUN curl 'https://pecl.php.net/get/xdebug-3.3.1.tgz' -o 'xdebug-3.3.1.tgz'
RUN printf "\n" | pecl install xdebug-3.3.1.tgz \
    && rm -rf xdebug-3.3.1.tgz \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable xdebug

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

RUN chown -R www:www /usr/local/etc/php-fpm.d/

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

USER www

# 9000 is listen by PHP-FPM self own
# EXPOSE 9001

CMD ["php-fpm"]

