set -e

chmod -R 775 storage
chmod -R 775 bootstrap/cache


chown -R www-data:www-data storage
chown -R www-data:www-data bootstrap/cache