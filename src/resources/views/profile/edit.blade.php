<x-app-layout>
    <form action="{{route('profile.update', $user)}}" method="post">
        @csrf
        @method('PUT')
        <div class="flex gap-10 mt-10 items-center">

            <div class="items-center gap-5">
                <p class="text-bold text-xl">Name</p>
                <input type="text" name="name" value="{{ $user->name }}" class="rounded-md">
                @error('name')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="items-center gap-5">
                <p class="text-bold text-xl">Email</p>
                <input type="text" name="email" value="{{ $user->email }}" class="rounded-md">
                @error('email')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-end">
                <input type="submit" value="Update" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600 cursor-pointer">
            </div>
        </div>
    </form>
</x-app-layout>