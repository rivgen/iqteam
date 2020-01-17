php bin/console cache:clear
php bin/console cache:clear --no-warmup --env=prod
php bin/console assets:install

//запуск webpack
 yarn encore dev
 yarn encore dev --watch
 yarn encore production
 
//работа с webpack
yarn watch
yarn build

php bin/console make:entity

//Создайте миграцию, сравнив вашу текущую базу данных с вашей картографической информацией.
php bin/console make:migration
//or
php bin/console doctrine:migrations:diff 
//Выполните миграцию на указанную версию или последнюю доступную версию.
php bin/console doctrine:migrations:migrate 


// doctrine:migrations:diff                [diff] Generate a migration by comparing your current database to your mapping information.
// doctrine:migrations:dump-schema         [dump-schema] Dump the schema for your database to a migration.
// doctrine:migrations:execute             [execute] Execute a single migration version up or down manually.
// doctrine:migrations:generate            [generate] Generate a blank migration class.
// doctrine:migrations:latest              [latest] Outputs the latest version number
// doctrine:migrations:migrate             [migrate] Execute a migration to a specified version or the latest available version.
// doctrine:migrations:rollup              [rollup] Rollup migrations by deleting all tracked versions and insert the one version that exists.
// doctrine:migrations:status              [status] View the status of a set of migrations.
// doctrine:migrations:up-to-date          [up-to-date] Tells you if your schema is up-to-date.
// doctrine:migrations:version             [version] Manually add and delete migration versions from the version table.


//очистка кеша картинок
php bin/console liip:imagine:cache:remove

//создание кеша картинок 
php bin/console liip:imagine:cache:resolve <PATH-OF-IMAGES>