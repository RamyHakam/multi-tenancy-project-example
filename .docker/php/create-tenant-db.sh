#!/bin/bash

# Create tenant DB command
/usr/local/bin/php /var/www/html/bin/console t:d:c
status=$?

# Check if the return value is 1 that means the DB was created
if [ $status -eq 0 ]; then
  # Wait for 5 seconds
  sleep 5

  # Migrate tenant DB command
  cd /var/www/html
  /usr/local/bin/php bin/console t:m:m init --no-interaction
fi
