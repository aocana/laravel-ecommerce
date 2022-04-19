docker-compose up -d
docker-compose run --rm composer install
docker-compose run --rm artisan key:generate
docker-compose run --rm artisan migrate
docker-compose run --rm npm install && npm run dev
curl \
  -X POST 'http://localhost:7700/indexes/products/settings/sortable-attributes' \
  -H 'Content-Type: application/json' \
  --data-binary '[
      "name"
  ]'