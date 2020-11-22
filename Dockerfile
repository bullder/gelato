FROM php:7.4.12-fpm-alpine3.12

ENV APP_DIR /app

WORKDIR $APP_DIR

COPY . /app

EXPOSE 80

CMD ["php", "-S", "0.0.0.0:80", "-t", "/app/public", "/app/public/index.php"]
