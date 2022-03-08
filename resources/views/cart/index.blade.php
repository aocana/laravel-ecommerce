<x-app-layout>
    <div class="py-12 sm:px-5 md:px-10 l:px-24 xl:px-40">
        <p>Cart</p>
        @forelse ($products as $product)
            <p>{{ $product->name }}</p>
        @empty
            <p>You don't added products</p>
        @endforelse
    </div>
</x-app-layout>