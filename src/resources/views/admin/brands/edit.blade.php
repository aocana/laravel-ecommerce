<x-admin-layout>
    <div class="flex items-center justify-between">
        <p class="text-2xl">Edit brand</p>
        <div>
            <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 font-medium tracking-wide text-white transition-colors duration-200 transform bg-red-600 rounded-md hover:bg-red-500 focus:outline-none focus:ring focus:ring-red-300 focus:ring-opacity-80">Delete brand</button>
            </form>
        </div>
    </div>


    <form action="{{route('admin.brands.update', $brand)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-3">
            <div>
                <label class="text-gray-700 dark:text-gray-200" for="name">Name</label>
                <input name="name" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring" value="{{ $brand->name }}">
                @error('name')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="text-gray-700 dark:text-gray-200" for="slug">Slug</label>
                <input name="slug" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring" value="{{ $brand->slug }}">
                @error('slug')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="text-gray-700 dark:text-gray-200" for="image">Image</label>
                <input name="image" type="file" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring" value="{{ $brand->file_path }}">
                @error('image')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-start mt-6">
            <input type="submit" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600" value="Update">
        </div>
    </form>
</x-admin-layout>