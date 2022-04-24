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

    public function createDocument(string $index, $model)
    {
        $data = [
            'id' => $model->id,
            'name' => $model->name,
            'customer' => $model->user->email,
            'created_at' => $model->created_at,
        ];

        $this->meilisearch->index($index)->addDocuments($data);
    }
}
