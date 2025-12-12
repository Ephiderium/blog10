FROM php:8.3-cli
WORKDIR /app
RUN apt-get update && apt-get install -y \
        libpq-dev \
        libxslt1-dev \
    && docker-php-ext-install -j$(nproc) pgsql pdo_pgsql xsl \
    && pecl install igbinary redis \
    && docker-php-ext-enable igbinary redis \
    && rm -rf /var/lib/apt/lists/*

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

COPY . /app/

EXPOSE 8000 5173

CMD ["sh", "-c", "npm run dev -- --host 0.0.0.0 & php artisan serve --host=0.0.0.0 --port=8000"]
