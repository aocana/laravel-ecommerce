<x-app-layout>
    <div class="py-12 sm:px-5 md:px-10 l:px-24 xl:px-40">
        <p class="mb-5 text-2xl">Cart</p>
        <hr>
        <form action="{{route('cart.checkout')}}" method="post">
            @csrf
            @forelse ($products as $product)
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
                <input type="text" name="price[]" hidden value="{{$product->stripe_price_id}}">
                <input type="number" name="quantity[]" min="1" max="10" value="1">
            </div>
            <hr>
            @empty
            <p>You don't added products</p>
            @endforelse
            <div class="flex justify-end mt-6">
                <input type="submit" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600 cursor-pointer" value="Checkout">
            </div>
        </form>
    </div>
</x-app-layout>