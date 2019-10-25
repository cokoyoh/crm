<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" xmlns:data="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen antialiased leading-none">

<section id="header-section" class="bg-cover bg-no-repeat mb-24 md:mb-64 xl:mb-48">
    <header class="container mx-auto p-4 flex items-center justify-between mb-12 md:mb-16 bg-gray-900">
        <a href="/" class="text-4xl font-weight-light text-white font-semibold tracking-widest ">CRM</a>

        <nav class="flex items-center">
            <a href="{!! route('login') !!}" class="hidden md:inline-block text-gray-400 hover:text-gray-100 ml-5">Login</a>
            <a href="#" class="inline-block text-white hover:text-gray-100 text-lg md:text-xl font-medium md:ml-8 mr-5 md:mr-0 px-3 md:px-4 py-2 md:py-3 rounded-lg border border-gray-800 hover:border-gray-500 whitespace-no-wrap">Begin Trial</a>
        </nav>
    </header>

    <div class="text-center max-w-3xl px-4 mx-auto mb-16">
        <h2 class="text-gray-700 text-3xl lg:text-5xl mb-6">Client management simplified. It doesn't have to be difficult.</h2>
        <p class="lg:text-2xl leading-tight lg:px-8 mb-10 text-gray-600">
            Manage client data and interactions with the most simple and easy to use CRM platform.
        </p>
        <div class="flex items-center justify-center">
            <a class="text-white bg-blue-500 hover:bg-blue-400 font-medium px-5 py-3 rounded-lg mr-1 sm:mr-3 whitespace-no-wrap" href="#">Register Now</a>
            <a id="features-link" class="text-gray-700 hover:text-gray-400 px-5 py-3 rounded-lg ml-1 sm:ml-3 whitespace-no-wrap" href="#features-section">Learn More</a>
        </div>
    </div>

</section>

<footer class="px-4 py-12 text-center text-gray-600 text-lg">
    <div class="flex items-center justify-center mb-6">
        <a href="#" class="mx-5 text-gray-700 hover:bg-gray-500">Terms of Use</a>
        <span class="text-gray-400 align-bottom">.</span>
        <a href="#" class="mx-5 text-gray-700 hover:bg-gray-500">Privacy Policy</a>
        <span class="text-gray-400 align-bottom">.</span>
        <a href="#" class="mx-5 text-gray-700 hover:bg-gray-500">All rights Reserverd</a>
    </div>
    Copyright © {!! config('company.name') !!}.
</footer>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
