FROM php:latest
LABEL maintainer="Pullak Barik <pullak10@gmail.com>"
LABEL name="task_manager v1"

RUN apt-get update -y && apt-get install -y libgmp-dev libonig-dev openssl libssl-dev libxml2-dev zip unzip git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install gmp pdo pdo_mysql bcmath phar mbstring json ctype xml tokenizer fileinfo
WORKDIR /task_manager
COPY . .
RUN composer install
CMD php artisan serve --host=0.0.0.0 --port=8181
EXPOSE 8181
