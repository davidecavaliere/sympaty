1 - install composer
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

2 - bootstrap a symfony project
composer create-project symfony/framework-standard-edition myproject/ ~2.5

3 - starting the webapp
php app/console server:run

4 - create a new entity + repository
(optional - create a new bundle - php app/console generate:bundle --namespace=Acme/StoreBundle)
php app/console doctrine:generate:entity

5 - bootstrap the database
php app/console doctrine:database:create

6 - update the database schema
php app/console doctrine:schema:update --force

7 - create a User Domain Entity
8 - adding relation 1 -> * between User and Post
9 - regenerate entities update schema

php app/console doctrine:generate:entities Acme
php app/console doctrine:schema:update --force
