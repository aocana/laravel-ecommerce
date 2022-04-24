<x-admin-layout>
    <p class="text-2xl">Create product</p>
    <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-3">
            <div>
                <label class="text-gray-700 dark:text-gray-200" for="name">Name</label>
                <input name="name" type="text" value="{{ old('name') }}" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                @error('name')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="text-gray-700 dark:text-gray-200" for="slug">Slug</label>
                <input name="slug" type="text" value="{{ old('slug') }}" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                @error('slug')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="text-gray-700 dark:text-gray-200" for="image">Image</label>
                <input name="image" type="file" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                @error('image')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="text-gray-700 dark:text-gray-200" for="price">Price</label>
                <input name="price" type="number" placeholder="1199.99" min="1" step=".01" value="{{ old('price') }}" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                @error('price')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="text-gray-700 dark:text-gray-200" for="stock">Stock</label>
                <input name="stock" type="number" min="1" value="{{ old('stock') }}" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                @error('stock')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="text-gray-700 dark:text-gray-200" for="price">SKU</label>
                <input name="sku" type="text" min="1" value="{{ old('sku') }}" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                @error('sku')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="text-gray-700 dark:text-gray-200" for="price">Category</label>
                <select name="category_id" type="number" min="1" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                    <option value=""></option>
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                @error('category_id')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="text-gray-700 dark:text-gray-200" for="price">Brand</label>
                <select name="brand_id" type="number" min="1" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                    <option value=""></option>
                    @foreach($brands as $brand)
                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                    @endforeach
                </select>
                @error('brand_id')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

            </div>

            <div>
                <label for="is_visible">Visible</label>
                <select name="is_visible">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                @error('is_visible')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mt-3">
            <label class="text-gray-700 dark:text-gray-200" for="description">Description</label>
            <textarea id="description" name="description" rows="3" cols="30" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring" placeholder="Description..."></textarea>
            @error('description')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end mt-6">
            <input type="submit" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600" value="Crear">
        </div>
    </form>
</x-admin-layout>