<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="post" action="{{ route('profile.new-password') }}">
            @csrf
            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Current Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" value="{{old('password')}}" required />
            </div>

            <!-- New Password -->
            <div class="mt-4">
                <x-label for="newPassword" :value="__('New password')" />

                <x-input id="newPassword" class="block mt-1 w-full" type="password" name="newPassword" required value="{{old('newPassword')}}" />
            </div>

            <!-- New Password Confirmation -->
            <div class="mt-4">
                <x-label for="confirmNewPassword" :value="__('Confirm new password')" />

                <x-input id="confirmNewPassword" class="block mt-1 w-full" type="password" name="newPassword_confirmation" required value="{{old('newPassword_confirmation')}}" />
            </div>

            <div class=" flex items-center justify-end mt-4">
                <input type="submit" value="Change password" class="ml-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 cursor-pointer">
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>