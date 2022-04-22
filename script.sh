docker-compose up -d
docker-compose run --rm composer install
docker-compose run --rm artisan key:generate
docker-compose run --rm artisan migrate
docker-compose run --rm artisan storage:link
docker-compose run --rm npm install && npm run dev