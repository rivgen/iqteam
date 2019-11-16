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