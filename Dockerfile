# docker build --rm --tag local .
# docker run local
# docker run local php vendor/bin/phpunit --configuration tests/phpunit.config.xml

FROM php:7.1.10

WORKDIR /var/php

COPY . /var/php/

# Install sqlite to crunch a small dataset
RUN apt-get -y update && apt-get -y install sqlite3 libsqlite3-dev

# Install composer (mostly for the PSR autoloader)
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN php composer.phar install

CMD ["php", "index.php"]