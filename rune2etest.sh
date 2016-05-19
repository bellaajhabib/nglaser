php app/console doctrine:database:drop --env=e2e --force
php app/console doctrine:database:create --env=e2e
php app/console doctrine:migrations:migrate --env=e2e
php app/console doctrine:fixtures:load --env=e2e
bin/codecept run acceptance --env chrome