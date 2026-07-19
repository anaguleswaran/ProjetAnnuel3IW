if [ ! -f /var/www/projet-annuel/Budgie/storage/seeded ]; then

    php artisan migrate --force
    php artisan db:seed --force

    touch /var/www/projet-annuel/Budgie/storage/seeded

else

    php artisan migrate --force

fi