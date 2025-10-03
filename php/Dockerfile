FROM php:8.3-cli

RUN apt update && apt install -y \
    sqlite3 \
    libsqlite3-dev \
    libxml2-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_sqlite

WORKDIR /var/www/html

COPY . .

CMD ["php", "-S", "0.0.0.0:7070", "-t", "public"]

EXPOSE 7070