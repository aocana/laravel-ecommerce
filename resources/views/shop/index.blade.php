<x-app-layout>
    <h1 class="text-4xl font-bold">Shop</h1>
    <p>
        @if (session('message'))
            <p>{{ session('message') }}</p>
        @endif
    </p>
    <div class="grid gap-8 grid-cols-4">
        @forelse($products as $product)
            <div class="rounded-lg border-solid border-2 border-gray-100 shadow-lg">
                <a href="#">
                    <img src="https://img02.honorfile.com/eu/es/honor/pms/product/6936520804108/428_428_4B417C7664EA24606D89FA2F599841CEE2313E64C37C7C78mp.jpg"
                        alt="{{ $product->name }}">
                </a>
                <p><a href="#">{{ $product->name }}</a></p>
                <p>{{ $product->price }}€</p>
                <p><a href="{{ route('cart.add', $product) }}">Add to cart</a></p>
            </div>
        @empty
            <p>No products found</p>
        @endforelse
    </div>
</x-app-layout>
