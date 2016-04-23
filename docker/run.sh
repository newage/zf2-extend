#!/bin/bash
VOLUME_HOME="/var/lib/mysql"

sed -ri -e "s/^error_reporting.*/error_reporting = E_ALL/" \
    -e "s/^display_errors.*/display_errors = ON/" \
    -e "s/^display_startup_errors.*/display_startup_errors = ON/" /etc/php5/apache2/php.ini

exec supervisord -n