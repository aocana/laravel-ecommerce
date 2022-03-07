<x-app-layout>
    <p>Shop</p>
    <div class="grid gap-4 grid-cols-3">
        @forelse($products as $product)
            <div>
                <p>{{$product->name}}</p>
                <p>{{$product->price}}€</p>
                <p><a href="{{route('cart.add', $product->id)}}">Add to cart</a></p>
            </div>
        @empty
            <p>No products found</p>
        @endforelse
    </div>
</x-app-layout>
