#!/usr/bin/env bash

set -x \
&& rm -rf /etc/nginx \
&& rm -rf /etc/supervisor \
&& mkdir /run/php

set -x \
&& cp -r "/usr/share/container_config/nginx" /etc/nginx \
&& cp -r "/usr/share/container_config/supervisor" /etc/supervisor

PG_HOST_SED=${PG_HOST//\//\\\/}
PG_HOST_SED=${PG_HOST_SED//\./\\\.}
PG_PASSWORD_SED=${PG_PASSWORD//\//\\\/}
PG_PASSWORD_SED=${PG_PASSWORD_SED//\./\\\.}

sed -i "s/__UPLOAD_MAX_DIMENSION__/$UPLOAD_MAX_DIMENSION/g" /etc/nginx/nginx.conf
sed -i "s/__UPLOAD_DIGEST_PREFIX__/$UPLOAD_DIGEST_PREFIX/g" /etc/nginx/sites/default.conf

sed -i "s/memory_limit = 128M/memory_limit = 512M/g" /etc/php/7.4/fpm/php.ini
sed -i "s/post_max_size = 8M/post_max_size = $UPLOAD_MAX_FILESIZE/g" /etc/php/7.4/fpm/php.ini
sed -i "s/upload_max_filesize = 2M/upload_max_filesize = $UPLOAD_MAX_FILESIZE/g" /etc/php/7.4/fpm/php.ini
sed -i "s/max_execution_time = 30/max_execution_time = $PHP_MAX_EXECUTION_TIME/g" /etc/php/7.4/fpm/php.ini
sed -i "s/memory_limit = 512M/memory_limit = $PHP_MEMORY_LIMIT/g" /etc/php/7.4/fpm/php.ini
sed -i "s/error_log = \/var\/log\/php7.4-fpm.log/error_log = \/dev\/stdout/g" /etc/php/7.4/fpm/php-fpm.conf
sed -i "s/;error_log = syslog/error_log = \/dev\/stdout/g" /etc/php/7.4/fpm/php.ini
sed -i "s/;error_log = syslog/error_log = \/dev\/stdout/g" /etc/php/7.4/cli/php.ini
sed -i "s/log_errors = Off/log_errors = On/g" /etc/php/7.4/cli/php.ini
sed -i "s/log_errors = Off/log_errors = On/g" /etc/php/7.4/fpm/php.ini
sed -i "s/log_errors_max_len = 1024/log_errors_max_len = 0/g" /etc/php/7.4/cli/php.ini
sed -i "s/user = www-data/user = upload/g" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/group = www-data/group = upload/g" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/pm = dynamic/pm = static/g" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/pm.max_children = 5/pm.max_children = ${PHP_PM_MAX_CHILDREN}/g" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/;pm.max_requests = 500/pm.max_requests = ${PHP_PM_MAX_REQUESTS}/g" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/listen.owner = www-data/listen.owner = upload/g" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/listen.group = www-data/listen.group = upload/g" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/;catch_workers_output = yes/catch_workers_output = yes/g" /etc/php/7.4/fpm/pool.d/www.conf

sed -i "s/PG_HOST/$PG_HOST_SED/g" /opt/upload/src/Resource/config/resources_shared.php
sed -i "s/PG_PORT/$PG_PORT/g" /opt/upload/src/Resource/config/resources_shared.php
sed -i "s/PG_DATABASE/$PG_DATABASE/g" /opt/upload/src/Resource/config/resources_shared.php
sed -i "s/PG_USER/$PG_USER/g" /opt/upload/src/Resource/config/resources_shared.php
sed -i "s/PG_PASSWORD/$PG_PASSWORD_SED/g" /opt/upload/src/Resource/config/resources_shared.php
sed -i "s/PG_HOST/$PG_HOST_SED/g" /opt/upload/src/Resource/propel/connection/propel.php
sed -i "s/PG_PORT/$PG_PORT/g" /opt/upload/src/Resource/propel/connection/propel.php
sed -i "s/PG_DATABASE/$PG_DATABASE/g" /opt/upload/src/Resource/propel/connection/propel.php
sed -i "s/PG_USER/$PG_USER/g" /opt/upload/src/Resource/propel/connection/propel.php
sed -i "s/PG_PASSWORD/$PG_PASSWORD_SED/g" /opt/upload/src/Resource/propel/connection/propel.php

sed -i "s/'upload' => 'http:\/\/upload'/'upload' => 'http:\/\/$UPLOAD_HOST'/g" /opt/upload/src/Resource/config/resources_shared.php
sed -i "s/'port' => 80/'port' => $UPLOAD_PORT/g" /opt/upload/src/Resource/config/resources_shared.php
sed -i "s/'digest' => ''/'digest' => '$UPLOAD_DIGEST_PREFIX'/g" /opt/upload/src/Resource/config/resources_shared.php
sed -i "s/'max_size' => ''/'max_size' => '$UPLOAD_MAX_FILESIZE'/g" /opt/upload/src/Resource/config/resources_shared.php
sed -i "s/'auth' => ''/'auth' => '$UPLOAD_AUTH'/g" /opt/upload/src/Resource/config/resources_shared.php
sed -i "s/'auth_salt' => ''/'auth_salt' => '$UPLOAD_AUTH_SALT'/g" /opt/upload/src/Resource/config/resources_shared.php
sed -i "s/'max_dimension' => ''/'max_dimension' => $UPLOAD_MAX_DIMENSION/g" /opt/upload/src/Resource/config/resources_shared.php
sed -i "s/'digest_length' => 10/'digest_length' => $UPLOAD_DIGEST_LENGTH/g" /opt/upload/src/Resource/config/resources_shared.php

set -x \
&& cd /opt/upload \
&& sudo -u upload php cli framework propel/migrate

touch /node_status_inited
