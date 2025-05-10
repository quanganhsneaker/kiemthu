FROM php:8.1-apache

# Cài các extension cần thiết
RUN apt-get update && apt-get install -y \
    git zip unzip curl libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip gd mbstring

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Sao chép toàn bộ mã nguồn Laravel vào container
COPY . /var/www/html/

# Cấp quyền cho thư mục cần thiết
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Mở cổng 8000 và khởi chạy Laravel
EXPOSE 8000
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
