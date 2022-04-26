<x-app-layout>
    @if (session('success'))
    <p>{{ session('success') }}</p>
    @endif
    <div class="flex gap-10 mt-10 items-center">
        <div class="flex items-center gap-5">
            <p class="text-bold text-xl">Name</p>
            <input type="text" value="{{ $user->name }}" disabled class="rounded-md">
        </div>
        <div class="flex items-center gap-5">
            <p class="text-bold text-xl">Email</p>
            <input type="text" value="{{ $user->email }}" disabled class="rounded-md">
        </div>
        <div class="flex items-center gap-5">
            <a href="{{route('profile.change-password')}}">Change password</a>
        </div>
        <a href="{{route('profile.edit', $user)}}" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600 cursor-pointer">Edit</a>
    </div>
</x-app-layout>