FROM richarvey/nginx-php-fpm

COPY . /var/www/html

COPY default.conf /etc/nginx/sites-available/

##COPY ./certificate/ /etc/certificate/

##COPY ./config_nginx/nginx.conf /etc/nginx/

##COPY ./config_nginx/sites-available/default /etc/nginx/sites-available/

##COPY ./config_nginx/sites-enabled/default /etc/nginx/sites-enabled/

#COPY ./config_nginx/ /etc/nginx/

EXPOSE 80/tcp