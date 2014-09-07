How to install:

1. composer install

2. php app/console doctrine:migrations:migrate

How to test:

1. php app/console doctrine:fixtures:load

2. ./bin/phpunit -c app/

3. ./bin/phpcs --standard=PSR2 src/