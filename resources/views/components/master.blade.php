<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tweety') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
<!--<link rel="stylesheet" href="{{ mix('css/app.css') }}">-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased">



<section class="px-8 py-4">
    <header class="container mx-auto">
        <h1>
            <img
                src="/images/logo1.jpg"
                alt="Tweety"
            >
        </h1>
    </header>
</section>

{{$slot}}

@stack('modals')

@livewireScripts
<script src="http://unpkg.com/turbolinks"></script>
</body>
</html>
