<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\FileService;
use App\Services\Stripe\CheckoutStripe;
use App\Services\Stripe\ProductsStripe;
use App\Services\Stripe\CustomersStripe;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private array $filterOptions;
    protected Collection $brands;
    protected Collection $categories;
    protected FileService $fileService;
    protected CustomersStripe $stripeCustomers;
    protected ProductsStripe $stripeProducts;
    protected CheckoutStripe $stripeCheckout;

    public function __construct()
    {
        $this->categories = Category::latest()->get();
        $this->brands = Brand::latest()->get();
        $this->fileService = new FileService();
        $this->stripeService = new ProductsStripe();
        $this->stripeCheckout = new CheckoutStripe();
        $this->stripeCustomer = new CustomersStripe();
        $this->filterOptions = [
            'sort' => [],
            'filter' => [],
        ];
    }

    /* Meilisearch */
    public function searchTemplate(Request $request, $model)
    {
        if ($request->sort) $this->filterOptions['sort'] = [$request->sort];

        $this->filterComprobation($request, 'brands', 'brand');
        $this->filterComprobation($request, 'categories', 'category');
        $this->filterComprobation($request, 'status', 'status');
        $this->filterComprobation($request, 'customer', 'customer');

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
                if ($singularType === "customer") {
                    array_push($filter, "$singularType = '$type'");
                } else {
                    array_push($filter, "$singularType = $type");
                }
            }
            array_push($this->filterOptions['filter'], $filter);
        }
    }
}
