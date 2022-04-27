<x-app-layout>
    <!-- <h1 class="text-4xl font-bold">Shop</h1> -->
    @if (session('message'))
    <div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <div class="ml-3 text-sm font-normal">{{ session('message') }}</div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>
    @endif
    @if (request('q'))
    <p class="text-2xl mb-10 text-bold text-center">{{ request('q') }} search results: </p>
    @endif
    <div class="grid gap-8 grid-cols-4">
        <form action="{{route('shop.search')}}" method="get" class="row-span-3">
            <div class="border-t border-gray-200 px-4 py-6">
                <select name="sort" class="-left-10 rounded-md">
                    <option selected disabled> Sort By</option>
                    <option value="name:asc">Name asc</option>
                    <option value="name:desc">Name desc</option>
                    <option value="price:asc">Price asc</option>
                    <option value="price:desc">Price desc</option>
                </select>
            </div>
            <!-- categories -->
            <div class="border-t border-gray-200 px-4 py-6">
                <h3 class="-mx-2 -my-3 flow-root">
                    <!-- Expand/collapse section button -->
                    <button type="button" id="categoryButton" class="px-2 py-3 bg-white w-full flex items-center justify-between text-gray-400 hover:text-gray-500">
                        <span class="font-medium text-gray-900">Categories</span>
                        <span class="ml-6 flex items-center">
                            <svg id="category-plus" class=" h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            <svg id="category-cross" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" style="display: none;">
                                <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </button>
                </h3>
                <!-- Expand/collapse -->
                <div class="pt-6" id="filter-category-mobile" style="display:none;">
                    <div class="space-y-6">
                        @foreach($categories as $category)
                        <div class="flex items-center">
                            <input id="filter-mobile-category-0" name="categories[]" value="{{ $category->name }}" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                            <label for="filter-mobile-category-0" class="ml-3 min-w-0 flex-1 text-gray-500">{{ $category->name }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- brand -->
            <div class="border-t border-gray-200 px-4 py-6">
                <h3 class="-mx-2 -my-3 flow-root">
                    <!-- Expand/collapse section button -->
                    <button type="button" id="brandButton" class="px-2 py-3 bg-white w-full flex items-center justify-between text-gray-400 hover:text-gray-500">
                        <span class="font-medium text-gray-900">Brands</span>
                        <span class="ml-6 flex items-center">
                            <svg id="brand-plus" class=" h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            <svg id="brand-cross" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" style="display: none;">
                                <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </button>
                </h3>
                <!-- Expand/collapse -->
                <div class="pt-6" id="filter-brand-mobile" style="display:none;">
                    <div class="space-y-6">
                        @foreach($brands as $brand)
                        <div class="flex items-center">
                            <input id="filter-mobile-category-0" name="brands[]" value="{{ $brand->name }}" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                            <label for="filter-mobile-category-0" class="ml-3 min-w-0 flex-1 text-gray-500">{{ $brand->name }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-10 justify-center">
                <a href="{{route('shop.index')}}" class="text-red-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </a>
                <input type="submit" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600 cursor-pointer" value="Filter">

            </div>
        </form>
        @forelse($products as $product)
        <a href="{{ route('shop.detail', $product) }}" class="group">
            <div class="w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden xl:aspect-w-7 xl:aspect-h-8">
                <img src="{{ asset('storage/' . $product->image) }}" alt="Tall slender porcelain bottle with natural clay textured body and cork stopper." class="w-full h-full object-center object-cover group-hover:opacity-75">
            </div>
            <h3 class="mt-4 text-sm text-gray-700">{{ $product->name }}</h3>
            <p class="mt-1 text-lg font-medium text-gray-900">{{ $product->price }} €</p>
        </a>
        <!-- <div class="rounded-lg border-solid border-2 border-gray-100 shadow-lg">
            <a href="{{ route('shop.detail', $product) }}">
                <img src="{{ asset('storage/' . $product->image) }}" width="200px" height="200px" alt="{{ $product->name }}">
            </a>
            <p><a href="#">{{ $product->name }}</a></p>
            <p>{{ $product->price }}€</p>
            <p><a href="{{ route('cart.add', $product) }}">Add to cart</a></p>
        </div> -->
        @empty
        <p>No products found</p>
        @endforelse
    </div>

    <p>{{ $products->links() }}</p>
</x-app-layout>