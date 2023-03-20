docker-compose build
docker-compose up -d
cp .env.example .env
cp symfony/.env.example symfony/.env
cp symfony/.env.test.example symfony/.env.test
docker-compose exec php composer install
docker-compose exec php bin/console doctrine:migration:migrate --no-interaction
docker-compose exec php bin/console cache:clear