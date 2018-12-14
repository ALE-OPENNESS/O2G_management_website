<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications.

## Learning Laravel

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 1100 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Docker

There is a `Dockerfile` in this project to simplify the deployment of the website.
But, a this point, the Nginx server is not configured automatically.

- To build : `docker build -t o2g-manag .`
- To run it : `docker run -p 8080:80 o2g-manag`
- To see what's in the docker with a terminal : `docker exec -ti o2g-manag bash`
- To try the app, launch a web-browser and entre the http adresse `localhost:8080`

## How to deploy this website

The website is accessible today with this URL `https://o2g-manag.ale-aapp.com`

Pre-requisites
- PHP 7.1.4 or newer version of PHP --> https://ayesh.me/Ubuntu-PHP-7.2
- Laravel --> https://laravel.com/docs/5.7/installation
- Nginx server --> https://www.digitalocean.com/community/tutorials/how-to-install-nginx-on-debian-9
- Git --> https://www.digitalocean.com/community/tutorials/how-to-install-git-on-debian-9

You just have to clone this project in /var/www/html on your server.

This is my Nginx config /etc/nginx/nginx.conf:

##

    events {
            worker_connections 768;
            # multi_accept on;
    }

    http {

            ##
            # Basic Settings
            ##

            sendfile on;
            tcp_nopush on;
            tcp_nodelay on;
            keepalive_timeout 65;
            types_hash_max_size 2048;
            # server_tokens off;

            # server_names_hash_bucket_size 64;
            # server_name_in_redirect off;

            include /etc/nginx/mime.types;
            default_type application/octet-stream;

            ##
            # SSL Settings
            ##

            ssl_protocols TLSv1 TLSv1.1 TLSv1.2; # Dropping SSLv3, ref: POODLE
            ssl_prefer_server_ciphers on;

            ##
            # Logging Settings
            ##

            access_log /var/log/nginx/access.log;
            error_log /var/log/nginx/error.log;

            ##
            # Gzip Settings
            ##

            gzip on;

            # gzip_vary on;
            # gzip_proxied any;
            # gzip_comp_level 6;
            # gzip_buffers 16 8k;
            # gzip_http_version 1.1;
            # gzip_types text/plain text/css application/json application/javascript text/xml application/xml application/xml+rss text/javascript;

            ##
            # Virtual Host Configs
            ##

            include /etc/nginx/conf.d/*.conf;
            include /etc/nginx/sites-enabled/default;
    }

And this is my /etc/nginx/sites-enabled/default

##
    server {
        listen 443;
    #    listen [::]:443 default_server ipv6only=off;

    ssl    on;
        ssl_certificate            /etc/certificate/bundle.crt;
        ssl_certificate_key        /etc/certificate/myserver.key;

        root /var/www/html/public;
            ##root   /usr/share/nginx/html/;
        index index.php index.html index.htm;
        server_name o2g-manag.ale-aapp.com www.o2g-manag.ale-aapp.com;
        charset   utf-8;
        gzip on;
        gzip_vary on;
        gzip_disable "msie6";
        gzip_comp_level 6;
        gzip_min_length 1100;
        gzip_buffers 16 8k;
        gzip_proxied any;
        gzip_types
            text/plain
            text/css
            text/js
            text/xml
            text/javascript
            application/javascript
            application/x-javascript
            application/json
            application/xml
            application/xml+rss;
        location / {
            try_files $uri $uri/ /index.php?$query_string;
        }
        location ~ \.php$ {
            try_files $uri /index.php =404;
            fastcgi_split_path_info ^(.+\.php)(/.+)$;
            fastcgi_pass unix:/run/php/php7.2-fpm.sock;
            fastcgi_index index.php;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            include fastcgi_params;
        }
        location ~* \.(?:jpg|jpeg|gif|png|ico|cur|gz|svg|svgz|mp4|ogg|ogv|webm|htc|svg|woff|woff2|ttf)$ {
        expires 1M;
        access_log off;
        add_header Cache-Control "public";
        }
        location ~* \.(?:css|js)$ {
        expires 7d;
        access_log off;
        add_header Cache-Control "public";
        }
        location ~ /\.ht {
            deny  all;
        }
    }