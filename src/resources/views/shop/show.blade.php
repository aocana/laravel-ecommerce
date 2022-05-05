<x-app-layout>
    @if (session('message'))
    <div id="toast-success" class="flex justify-end items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 right-0" role="alert">
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
    <div class="container px-5 py-24 mx-auto">
        <div class="lg:w-4/5 mx-auto flex flex-wrap">
            <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded" src="{{ asset('storage/' . $product->image) }}">
            <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $product->name }}</h1>
                <div class="flex mt-2 mb-4 gap-5">
                    @if($product->category)
                    <a href="{{ route('categories.show', $product->category) }}">{{ $product->category->name }}</a>
                    @endif
                    @if($product->brand)
                    <a href="{{ route('brands.show', $product->brand) }}">{{ $product->brand->name }}</a>
                    @endif
                </div>
                <p class="leading-relaxed">{{ $product->description }}</p>
                <div class="flex mt-10 items-center">
                    @if($product->stock < 150) <p class="text-red-500 border-2 border-red-500 py-2 px-4 focus:outline-none rounded mt-10 sm:mt-0">Only {{ $product->stock }} in stock</p>
                        @else
                        <p class="border-2 border-green-600 py-2 px-4 rounded">In stock</p>
                        @endif
                </div>
                <div class="flex mt-10 items-center">
                    <span class="title-font font-bold text-2xl text-gray-900">{{ $product->price }} €</span>
                    <a href="{{ route('cart.add', $product) }}" class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">Add to cart</a>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>