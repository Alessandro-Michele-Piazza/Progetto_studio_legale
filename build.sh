
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php --install-dir=/tmp --filename=composer
php -r "unlink('composer-setup.php');"

/tmp/composer install --no-dev --optimize-autoloader

npm ci