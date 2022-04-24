<?php

namespace App\Services;

use MeiliSearch\Client;


class MeilisearchService
{
    private Client $meilisearch;

    public function __construct()
    {
        $this->meilisearch = new Client(env('MEILISEARCH_HOST'));
    }

    public function search(string $index, ?string $query, ?array $options)
    {
        $result = $this->meilisearch->index($index)->search($query, $options);
        return $result->getHits();
    }

    public function createDocument(string $index, $model)
    {
        $data = [
            'id' => $model->id,
            'name' => $model->name,
        ];

        if ($model->price) {
            $data['price'] = $model->price;
        }

        if ($model->brand_id) {
            $data['brand'] = $model->brand->name;
        }

        if ($model->category_id) {
            $data['category'] = $model->category->name;
        }

        $this->meilisearch->index($index)->addDocuments($data);
    }
}
