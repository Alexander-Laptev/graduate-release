#!/bin/bash
set -e

echo "Deployment started ..."

cd ..
cd var/www/graduate

git pull

docker-compose -f docker-compose.prod.yml up -d

docker exec -it graduate_app bash

# Enter maintenance mode or return true
# if already is in maintenance mode
(php artisan down) || true

# Pull the latest version of the app


# Install composer dependencies
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Clear the old cache
php artisan clear-compiled

# Recreate cache
php artisan optimize

# Run database migrations
php artisan migrate --force

# Exit maintenance mode
php artisan up

exit

echo "Deployment finished!"
