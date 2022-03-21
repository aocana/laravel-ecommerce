<x-app-layout>
    <!-- <h1 class="text-4xl font-bold">Shop</h1> -->
    <p>
        @if (session('message'))
    <p>{{ session('message') }}</p>
    @endif
    </p>
    <div class="grid gap-8 grid-cols-4">
        <form action="{{route('shop.search')}}" method="get" class="row-span-3">
            <p class="mb-5"><a href="{{route('shop.index')}}">Clear filters</a></p>

            <!-- brand -->
            <div class="border-t border-gray-200 px-4 py-6">
                <h3 class="-mx-2 -my-3 flow-root">
                    <!-- Expand/collapse section button -->
                    <button type="button" id="brandButton" class="px-2 py-3 bg-white w-full flex items-center justify-between text-gray-400 hover:text-gray-500">
                        <span class="font-medium text-gray-900">Category</span>
                        <span class="ml-6 flex items-center">
                            <svg id="filter-section-1-plus" class=" h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            <svg id="filter-section-1-cross" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" style="display: none;">
                                <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </button>
                </h3>
                <!-- Expand/collapse -->
                <div class="pt-6" id="filter-section-mobile-1" style="display:none;">
                    <div class="space-y-6">
                        <div class="flex items-center">
                            <input id="filter-mobile-category-0" name="brand[]" value="Apple" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                            <label for="filter-mobile-category-0" class="ml-3 min-w-0 flex-1 text-gray-500">Apple</label>
                        </div>
                        <div class="flex items-center">
                            <input id="filter-mobile-category-0" name="brand[]" value="HP" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                            <label for="filter-mobile-category-0" class="ml-3 min-w-0 flex-1 text-gray-500">HP</label>
                        </div>
                    </div>
                </div>
            </div>

            <input type="submit" value="Filter" class="bg-blue-500">
        </form>
        @forelse($products as $product)
        <div class="rounded-lg border-solid border-2 border-gray-100 shadow-lg">
            <a href="#">
                <img src="https://img02.honorfile.com/eu/es/honor/pms/product/6936520804108/428_428_4B417C7664EA24606D89FA2F599841CEE2313E64C37C7C78mp.jpg" alt="{{ $product->name }}">
            </a>
            <p><a href="#">{{ $product->name }}</a></p>
            <p>{{ $product->price }}€</p>
            <p><a href="{{ route('cart.add', $product) }}">Add to cart</a></p>
        </div>
        @empty
        <p>No products found</p>
        @endforelse
    </div>
    <p>{{ $products->links() }}</p>
</x-app-layout>