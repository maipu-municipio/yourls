#!/bin/sh
set -e

# Generate user/config.php from the docker template + env vars on every start,
# so config always reflects the current .env (no manual editing inside the container).
cp /usr/local/etc/yourls/config.docker.php /var/www/html/user/config.php
chown www-data:www-data /var/www/html/user/config.php

exec "$@"
