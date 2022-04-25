<x-admin-layout>
    <div class="flex">
        <img src="{{ asset('storage/' . $product->image) }}" class="w-96">
        <div>
            <p class="text-2xl">{{ $product->name }}</p>
            @if($product->category)
            <p>{{ $product->category->name }}</p>
            @endif
            @if($product->brand)
            <p>{{ $product->brand->name }}</p>
            @endif
            <p>{{ $product->price }} €</p>
        </div>
    </div>
    <div class="mt-10">
        <p>Description</p>
        {{ $product->description }}
    </div>
</x-admin-layout>