<x-app-layout>
    <div class="py-12 sm:px-5 md:px-10 l:px-24 xl:px-40">
        <p class="mb-5 text-2xl">Cart</p>
        <form action="{{route('cart.checkout')}}" method="post">
            @csrf
            @forelse ($products as $product)
            <hr>
            <div class="flex justify-between my-10 px-20">
                <div class="flex">
                    @if($product->image)
                    <img class="h-14 w-14 rounded-full" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    @endif
                    <div>
                        <p>{{ $product->name }}</p>
                        <p>{{ $product->price }} €</p>
                    </div>
                </div>
                <div class="flex align-center items-center gap-5">
                    <input type="number" name="quantity[]" min="1" max="10" value="1">
                    <a href="{{route('cart.delete', $product)}}" class="text-red-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </a>
                </div>
                <input type="text" name="price[]" hidden value="{{$product->stripe_price_id}}">
            </div>
            @empty
            <p>You don't added products <a href="{{route('shop.index')}}">GO SHOP</a></p>
            @endforelse
            @if(count($products) > 0)
            <div class=" flex justify-end mt-6">
                <input type="submit" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600 cursor-pointer" value="Checkout">
            </div>
            @endif
        </form>
    </div>
</x-app-layout>