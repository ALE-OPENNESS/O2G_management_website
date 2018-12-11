FROM richarvey/nginx-php-fpm

COPY . /var/www/html

COPY default.conf /etc/nginx/sites-available/

EXPOSE 80/tcp