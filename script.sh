docker-compose up -d
docker-compose run --rm composer install
docker-compose run --rm artisan key:generate
docker-compose run --rm artisan migrate
docker-compose run --rm artisan storage:link
docker-compose run --rm npm install && npm run dev

curl \
  -X POST 'http://localhost:7700/indexes' \
  -H 'Content-Type: application/json' \
  --data-binary '{
    "uid": "products",
    "primaryKey": "id"
  }'

  curl \
  -X POST 'http://localhost:7700/indexes/products/settings/searchable-attributes' \
  -H 'Content-Type: application/json' \
  --data-binary '[
      "name"
  ]'

  curl \
  -X POST 'http://localhost:7700/indexes/products/settings/sortable-attributes' \
  -H 'Content-Type: application/json' \
  --data-binary '[
      "name",
			"price"
  ]'

  curl \
  -X POST 'http://localhost:7700/indexes/products/settings/filterable-attributes' \
  -H 'Content-Type: application/json' \
  --data-binary '[
      "brand",
      "category"
  ]'


  curl \
  -X POST 'http://localhost:7700/indexes' \
  -H 'Content-Type: application/json' \
  --data-binary '{
    "uid": "categories",
    "primaryKey": "id"
  }'

  curl \
  -X POST 'http://localhost:7700/indexes/categories/settings/sortable-attributes' \
  -H 'Content-Type: application/json' \
  --data-binary '[
      "name"
  ]'

  curl \
  -X POST 'http://localhost:7700/indexes' \
  -H 'Content-Type: application/json' \
  --data-binary '{
    "uid": "brands",
    "primaryKey": "id"
  }'

  curl \
  -X POST 'http://localhost:7700/indexes/brands/settings/sortable-attributes' \
  -H 'Content-Type: application/json' \
  --data-binary '[
      "name"
  ]'

  curl \
  -X POST 'http://localhost:7700/indexes/orders/settings/searchable-attributes' \
  -H 'Content-Type: application/json' \
  --data-binary '[
      "id",
			"customer",
      "created_at"
  ]'

  curl \
  -X POST 'http://localhost:7700/indexes/orders/settings/filterable-attributes' \
  -H 'Content-Type: application/json' \
  --data-binary '[
      "status",
			"customer"
  ]'