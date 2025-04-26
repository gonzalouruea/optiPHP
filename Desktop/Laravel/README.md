Para la migracion de las tablas de la base de datos, ejecutar el siguiente comando:

docker-compose run --rm composer require --dev "kitloong/laravel-migrations-generator"

Despues:

docker-compose exec php_apache php artisan migrate:generate

Aunque tuve problemas con el comando, ya que tenia error pero estaba en el .env
