# job-portal

#first install laravel 12+ version using composer intall or update
#then install scantum Api using installer
-) composer require laravel/sanctum
-) php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
-) php artisan migrate
#  php artisan db:seed  run this command for seed all data using facker 
# last php artisan serve for config server
