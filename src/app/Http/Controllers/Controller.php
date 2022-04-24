<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FileService;
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
    private array $filterOptions;

    public function __construct()
    {
        $this->fileService = new FileService();
        $this->stripeService = new ProductsStripe();
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

    public function searchTemplate(Request $request, $model)
    {
        if ($request->sort) $this->filterOptions['sort'] = [$request->sort];

        $this->filterComprobation($request, 'brands', 'brand');
        $this->filterComprobation($request, 'categories', 'category');

        $query = $request->q;
        $options = $this->filterOptions;
        $searchResults =  $model::search($query, function ($meilisearch) use ($query, $options) {
            return $meilisearch->search($query, $options);
        })
            ->paginate(9);

        return $searchResults;
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
