minimal API for record transfer using laravel and mysql database

## How to Clone and Run Project

git clone https://github.com/syashori/api-transfer-bank

###########################################################

cd .\api-transfer-bank\

###########################################################

composer install

###########################################################

cp .env.example .env

pastikan parameter database sesuai pada file .env

###########################################################

php artisan migrate

###########################################################

php artisan db:seed

###########################################################

php artisan serve

gunakan credential <br />
email : user@boscod.com <br />
password : password
