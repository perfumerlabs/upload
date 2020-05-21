FROM ubuntu:xenial

MAINTAINER Ilyas Makashev <mehmatovec@gmail.com>

COPY init.sh /usr/local/bin/init.sh
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
COPY nginx /usr/share/container_config/nginx
COPY supervisor /usr/share/container_config/supervisor
COPY project /opt/upload

RUN set -x \
    && apt-get update && apt-get install -y --no-install-recommends curl gnupg2 ca-certificates wget locales && rm -rf /var/lib/apt/lists/* \
    && useradd -s /bin/bash -m upload \
    && echo "deb http://nginx.org/packages/ubuntu/ xenial nginx" > /etc/apt/sources.list.d/nginx.list \
    && echo "deb-src http://nginx.org/packages/ubuntu/ xenial nginx" >> /etc/apt/sources.list.d/nginx.list \
    && echo "deb http://ppa.launchpad.net/ondrej/php/ubuntu xenial main" > /etc/apt/sources.list.d/php.list \
    && echo "deb-src http://ppa.launchpad.net/ondrej/php/ubuntu xenial main" >> /etc/apt/sources.list.d/php.list \
    && apt-key adv --keyserver keyserver.ubuntu.com --recv-keys ABF5BD827BD9BF62 \
    && apt-key adv --keyserver keyserver.ubuntu.com --recv-keys 4F4EA0AAE5267A6C \
    && apt update \
    && apt install -y \
        nginx \
        php-igbinary \
        php-imagick \
        php7.3 \
        php7.3-cli \
        php7.3-common \
        php7.3-curl \
        php7.3-fpm \
        php7.3-json \
        php7.3-mbstring \
        php7.3-opcache \
        php7.3-pgsql \
        php7.3-readline \
        php7.3-xml \
        supervisor \
        vim \
        git \
        zip \
        sudo \
    && chmod +x /usr/local/bin/entrypoint.sh \
    && chmod +x /usr/local/bin/init.sh \
    && mkdir -p /opt/upload/files \
    && mkdir -p /opt/upload/web/cache \
    && chmod 777 /opt/upload/files \
    && chmod 777 /opt/upload/web/cache \
    && chown -R upload:upload /opt/upload \
    && cd /opt/upload \
    && sudo -u upload php composer.phar install --no-dev --prefer-dist

ENV PG_HOST postgresql
ENV PG_PORT 5432
ENV PG_DATABASE upload
ENV PG_USER postgres
ENV PG_PASSWORD postgres
ENV UPLOAD_HOST upload
ENV UPLOAD_PORT 80
ENV UPLOAD_MAX_FILESIZE 10M
ENV UPLOAD_MAX_DIMENSION 1000
ENV UPLOAD_DIGEST_PREFIX ''
ENV UPLOAD_DIGEST_LENGTH 10
ENV UPLOAD_AUTH 'false'
ENV UPLOAD_AUTH_SALT ''
ENV PHP_MAX_EXECUTION_TIME 60
ENV PHP_MEMORY_LIMIT 512M
ENV PHP_PM_MAX_CHILDREN 10
ENV PHP_PM_MAX_REQUESTS 500

VOLUME /opt/upload/files
VOLUME /opt/upload/web/cache

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
