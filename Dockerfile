# Update system core

RUN apt update && apt install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev libxml2-dev libcurl4-gnutls-dev


RUN docker-php-ext-install -j$(nproc) mysqli \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

# Start PHP-FPM
CMD ["php-fpm"]