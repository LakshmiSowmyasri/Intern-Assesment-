#!/bin/sh
set -e

# Create sqlite database if DB_CONNECTION is sqlite and database does not exist
if [ "$DB_CONNECTION" = "sqlite" ] || [ -z "$DB_CONNECTION" ]; then
    mkdir -p /var/www/html/database
    touch /var/www/html/database/database.sqlite
    chown -R www-data:www-data /var/www/html/database
fi

# Generate app key if not set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Run migrations and seeder
php artisan migrate --force --seed || true

# Execute CMD
exec "$@"
