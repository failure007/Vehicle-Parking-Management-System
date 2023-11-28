FROM php:8.0-cli

WORKDIR /app

COPY . /app

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install mysqli && \
    apt-get update && apt-get install -y \
    # Additional packages if needed
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

CMD ["php", "./vendor/bin/phpunit", "--configuration", "phpunit.xml"]
