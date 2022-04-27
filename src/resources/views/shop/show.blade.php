<x-app-layout>

    <div class="container px-5 py-24 mx-auto">
        <div class="lg:w-4/5 mx-auto flex flex-wrap">
            <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-52 object-cover object-center rounded" src="{{ asset('storage/' . $product->image) }}">
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