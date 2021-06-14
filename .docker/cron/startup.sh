#!/bin/sh
set -e

role=${CONTAINER_ROLE:-cron}

cd /var/www

if [ "$role" = "cron" ]; then
  while [ true ]
  do
      php /var/www/artisan schedule:run --verbose --no-interaction &
      sleep 60
  done

elif [ "$role" = "websocket" ]; then
  # Ensure we have vendor/ ready
  while [ ! -f /var/www/vendor/autoload.php ]
  do
      echo "App container might not be ready yet... sleeping..."
      sleep 30
  done

  php artisan websocket:serve

else
    echo "Could not match the container role \"$role\""
    exit 1
fi


