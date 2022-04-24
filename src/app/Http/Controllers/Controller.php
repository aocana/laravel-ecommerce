<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FileService;
use App\Services\MeilisearchService;
use App\Services\Stripe\CheckoutStripe;
use App\Services\Stripe\CustomersStripe;
use App\Services\Stripe\ProductsStripe;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected FileService $fileService;
    protected CustomersStripe $stripeCustomers;
    protected ProductsStripe $stripeProducts;
    protected CheckoutStripe $stripeCheckout;
    protected MeilisearchService $meilisearch;
    private array $filterOptions;

    public function __construct()
    {
        $this->fileService = new FileService();
        $this->stripeService = new ProductsStripe();
        $this->meilisearch = new MeilisearchService();
        $this->stripeCheckout = new CheckoutStripe();
        $this->stripeCustomer = new CustomersStripe();
        $this->filterOptions = [
            'sort' => [],
            'filter' => [],
        ];
    }

    public function __call($name, $arguments)
    {
        [$model, $action] = $arguments;

        $data = [
            'name' => request()->name,
            'slug' => request()->slug,
        ];

        return $action === 'create'
            ? $model::$action($data)
            : $model->$action($data);
    }

    public function searchTemplate(Request $request, string $meiliIndex, $model)
    {
        if ($request->sort) $this->filterOptions['sort'] = [$request->sort];

        $this->filterComprobation($request, 'brands', 'brand');
        $this->filterComprobation($request, 'categories', 'category');

        $meilisearchResults = collect($this->meilisearch->search($meiliIndex, $request->input('q'), $this->filterOptions));

        return $model::whereIn('id', $meilisearchResults->pluck('id'))
            ->paginate(9);
    }

    public function filterComprobation(Request $request, string $types, string $singularType)
    {
        if ($request->$types) {
            $filter = [];
            foreach ($request->$types as $type) {
                array_push($filter, "$singularType = $type");
            }
            array_push($this->filterOptions['filter'], $filter);
        }
    }
}
