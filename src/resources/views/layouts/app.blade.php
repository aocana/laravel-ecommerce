<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/shopFilter.js') }}" defer></script>

    <script src="https://js.stripe.com/v3/"></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <!-- Page Content -->
        <main class="mt-28 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </main>
    </div>
</body>

</html>