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

{{--<section id="header-section" class="bg-cover bg-no-repeat mb-24 md:mb-64 xl:mb-48 h-auto pb-8"--}}
<section id="header-section" class="bg-cover bg-no-repeat mb-24 md:mb-20 xl:mb-40 h-auto pb-16"
         style="background-image: url('/images/background/dark-image.jpeg');">
    <header class="container mx-auto p-4 flex items-center justify-between mb-12 md:mb-16 bg-transparent">
        <a href="/" class="text-4xl font-weight-light text-white font-semibold tracking-widest ">CRM</a>

        <nav class="flex items-center">
            <a href="{!! route('login') !!}"
               class="hidden md:inline-block text-gray-400 hover:text-gray-100 ml-5">Login</a>
            <a href="#"
               class="inline-block text-white hover:text-gray-100 text-lg md:text-xl font-medium md:ml-8 mr-5 md:mr-0 px-3 md:px-4 py-2 md:py-3 rounded-lg border border-gray-800 hover:border-gray-500 whitespace-no-wrap">Begin
                Trial</a>
        </nav>
    </header>

    <div class="text-center max-w-3xl px-4 mx-auto">
        <h2 class="text-teal-100 text-4xl lg:text-6xl mb-6">Client management simplified. It doesn't have to be
            difficult.</h2>
        <p class="lg:text-2xl leading-tight lg:px-8 mb-10 text-gray-400">
            Manage client data and interactions with the most simple and easy to use CRM platform.
        </p>
        <div class="flex items-center justify-center">
            <a class="text-white bg-blue-500 hover:bg-blue-400 font-medium px-5 py-3 rounded-lg mr-1 sm:mr-3 whitespace-no-wrap"
               href="#">Register Now</a>
            <a id="features-link"
               class="text-gray-500 hover:text-gray-300 px-5 py-3 rounded-lg ml-1 sm:ml-3 whitespace-no-wrap"
               href="#features-section">Learn More</a>
        </div>
    </div>

    {{--    <div class="relative container xl:max-w-5xl mx-auto">--}}
    {{--        <img class="absolute block w-full" src="/images/background/bg-hologram.png" alt="Jamiicare CRM Beauty">--}}
    {{--    </div>--}}
</section>

<section id="features-section" class="container mx-auto px-6 py-12 md:py-16">
    <h3 class="text-3xl md:text-4xl text-center text-blue-900 mb-12 lg:mb-24 leading-tight">
        Jamiicare is serving
        <br class="md:hidden">
        <span class="text-teal-500 border-b-4 border-teal-200 pb-1">100 companies</span>
    </h3>
    <div class="flex flex-wrap sm:-mx-6">
        <div class="w-full sm:w-1/2 lg:w-1/3 sm:px-6 mb-12">
            <svg class="block h-8 mb-6 text-teal-500" viewBox="0 0 33 32" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M12 23H7.5a6 6 0 0 1-1-11.917V11c0-5.523 4.477-10 10-10s10 4.477 10 10v.083A6.002 6.002 0 0 1 25.5 23H21"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M10.5 17l6-6 6 6M16.5 11v20" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round"></path>
            </svg>
            <h4 class="text-blue-900 font-medium mb-3">Client Data Management</h4>
            <p class="text-lg leading-tight">We track all your client data and manage them for you so you don't have to.
            </p>
        </div>
        <div class="w-full sm:w-1/2 lg:w-1/3 sm:px-6 mb-12">
            <svg class="block h-8 mb-6 text-teal-500" viewBox="0 0 32 32" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" d="M11 15l20-8v16l-20 8V15z" stroke="currentColor" stroke-width="2"
                      stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M6.907 23.037L1 25V9l20-8v6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round"></path>
            </svg>
            <h4 class="text-blue-900 font-medium mb-3">Scheduled Interactions</h4>
            <p class="text-lg leading-tight">All your client interactions for the day, week, month will be available to you using automated reminders.</p>
        </div>
        <div class="w-full sm:w-1/2 lg:w-1/3 sm:px-6 mb-12">
            <svg class="block h-8 mb-6 text-teal-500" viewBox="0 0 32 32" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M16 31H3a2 2 0 0 1-2-2V13a2 2 0 0 1 2-2h18a2 2 0 0 1 2 2v1M5 11V8a7 7 0 0 1 14 0"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                <path clip-rule="evenodd" d="M24 31a7 7 0 1 0 0-14 7 7 0 0 0 0 14z" stroke="currentColor"
                      stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M21 24l2 2 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round"></path>
            </svg>
            <h4 class="text-blue-900 font-medium mb-3">Deals Management</h4>
            <p class="text-lg leading-tight">All your deals are tracked and records kept safely. Just for you.</p>
        </div>
        <div class="w-full sm:w-1/2 lg:w-1/3 sm:px-6 mb-12">
            <svg class="block h-8 mb-6 text-teal-500" viewBox="0 0 32 32" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd"
                      d="M16 21a5 5 0 1 0 0-10 5 5 0 0 0 0 10zM16 24c-4.922 0-7.887 2.492-9.477 4.502C5.648 29.608 6.525 31 7.935 31h16.13c1.41 0 2.287-1.392 1.412-2.498C23.887 26.492 20.922 24 16 24z"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                <path
                    d="M28.02 24.975A14.933 14.933 0 0 0 31 16c0-8.284-6.716-15-15-15C7.716 1 1 7.716 1 16c0 3.419 1.074 6.477 3 9"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            <h4 class="text-blue-900 font-medium mb-3">Events Scheduling</h4>
            <p class="text-lg leading-tight">Using our automated events manager, we help you manage events and integrate them with clients</p>
        </div>
        <div class="w-full sm:w-1/2 lg:w-1/3 sm:px-6 mb-12">
            <svg class="block h-8 mb-6 text-teal-500" viewBox="0 0 32 32" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8.718 28.542l.503-.865a1 1 0 0 0-1.5.802l.997.063zm3.562 1.476l.75.662a1 1 0 0 0-.495-1.628l-.255.966zm-3.631-.369l-.998-.062a1 1 0 0 0 .523.942l.475-.88zm2.897 1.201l-.287.958a1 1 0 0 0 1.037-.296l-.75-.662zm8.909 0l-.75.662a1 1 0 0 0 1.036.296l-.287-.958zm-.734-.832l-.256-.966a1 1 0 0 0-.494 1.628l.75-.662zm3.56-1.476l.999-.063a1 1 0 0 0-1.501-.802l.503.865zm.07 1.107l.475.88a1 1 0 0 0 .523-.942l-.998.062zm7.5-9.195l.957.287a1 1 0 0 0-.296-1.037l-.662.75zm-1.202 2.897l-.062.998a1 1 0 0 0 .942-.523l-.88-.475zm-1.107-.07l-.865-.502a1 1 0 0 0 .802 1.5l.063-.997zm1.476-3.56l.662-.75a1 1 0 0 0-1.628.494l.966.256zM29.65 8.649l.88-.475a1 1 0 0 0-.942-.523l.062.998zm1.201 2.897l.662.75a1 1 0 0 0 .296-1.037l-.958.287zm-.832.734l-.966.255a1 1 0 0 0 1.628.495l-.662-.75zm-1.476-3.562l-.063-.998a1 1 0 0 0-.802 1.501l.865-.503zM20.454 1.15l.287-.958a1 1 0 0 0-1.037.296l.75.662zm2.897 1.2l.998.063a1 1 0 0 0-.523-.942l-.475.88zm-.07 1.108l-.502.864a1 1 0 0 0 1.5-.801l-.997-.063zm-3.56-1.476l-.75-.662a1 1 0 0 0 .494 1.628l.256-.966zM8.649 2.35l-.475-.88a1 1 0 0 0-.523.942l.998-.062zm2.897-1.201l.75-.662a1 1 0 0 0-1.037-.296l.287.958zm.734.832l.255.966a1 1 0 0 0 .495-1.628l-.75.662zM8.718 3.458l-.998.063a1 1 0 0 0 1.501.801l-.503-.864zM1.15 11.546l-.958-.287a1 1 0 0 0 .296 1.037l.662-.75zm1.2-2.897l.063-.998a1 1 0 0 0-.942.523l.88.475zm1.108.07l.864.502a1 1 0 0 0-.801-1.5l-.063.997zm-1.476 3.56l-.662.75a1 1 0 0 0 1.628-.494l-.966-.255zm.369 11.072l-.88.475a1 1 0 0 0 .942.523l-.062-.998zM1.15 20.455l-.662-.75a1 1 0 0 0-.296 1.036l.958-.287zm.832-.734l.966-.256a1 1 0 0 0-1.628-.494l.662.75zm1.476 3.56l.063.999a1 1 0 0 0 .801-1.501l-.864.503zm4.758 6.125a15.416 15.416 0 0 0 3.808 1.579l.511-1.933a13.41 13.41 0 0 1-3.314-1.375l-1.005 1.73zm1.431.306l.07-1.108-1.997-.125-.069 1.108 1.996.125zm2.185.18a14.404 14.404 0 0 1-2.708-1.123l-.95 1.76c.973.526 2.006.956 3.085 1.28l.573-1.917zm-.303-.535l-.733.832 1.5 1.323.734-.832-1.5-1.323zm9.675.832l-.733-.832-1.5 1.323.733.832 1.5-1.323zm-1.228.796a15.416 15.416 0 0 0 3.808-1.579l-1.005-1.729a13.41 13.41 0 0 1-3.314 1.375l.511 1.933zm2.308-2.38l.069 1.107 1.996-.125-.07-1.108-1.995.125zm.592.164c-.855.462-1.762.84-2.709 1.123l.574 1.916a16.399 16.399 0 0 0 3.085-1.279l-.95-1.76zm7.016-8.601a14.403 14.403 0 0 1-1.123 2.708l1.76.95c.526-.973.956-2.006 1.28-3.085l-1.917-.573zm-.18 2.185l-1.108-.07-.125 1.997 1.108.069.125-1.996zm-.306 1.431a15.416 15.416 0 0 0 1.579-3.808l-1.933-.511a13.41 13.41 0 0 1-1.375 3.314l1.73 1.005zm-.05-3.313l.833.733 1.323-1.5-.832-.733-1.323 1.5zM28.77 9.124c.462.855.84 1.761 1.123 2.708l1.916-.573a16.399 16.399 0 0 0-1.279-3.085l-1.76.95zm1.42 1.672l-.832.734 1.323 1.5.832-.734-1.323-1.5zm.796 1.228a15.416 15.416 0 0 0-1.579-3.808L27.677 9.22a13.41 13.41 0 0 1 1.375 3.314l1.933-.511zm-2.38-2.307l1.107-.07-.125-1.996-1.108.07.125 1.996zm-8.438-7.61c.947.284 1.854.662 2.709 1.124l.95-1.76A16.403 16.403 0 0 0 20.74.19l-.573 1.917zm2.186.181l-.07 1.108 1.997.125.069-1.108-1.996-.125zm1.431.306a15.413 15.413 0 0 0-3.808-1.579l-.511 1.933c1.175.311 2.287.777 3.314 1.374l1.005-1.728zm-3.313.05l.733-.833-1.5-1.323-.733.832 1.5 1.323zM9.124 3.23c.855-.462 1.761-.84 2.708-1.123L11.26.192A16.403 16.403 0 0 0 8.174 1.47l.95 1.76zm1.672-1.42l.734.832 1.5-1.323-.734-.832-1.5 1.323zm1.228-.796c-1.351.358-2.63.893-3.808 1.579L9.22 4.322a13.412 13.412 0 0 1 3.314-1.374l-.511-1.933zm-2.307 2.38l-.07-1.107-1.996.125.07 1.108 1.996-.125zm-7.61 8.438c.284-.947.662-1.854 1.124-2.709l-1.76-.95A16.403 16.403 0 0 0 .19 11.26l1.917.573zm.181-2.186l1.108.07.125-1.997-1.108-.069-.125 1.996zm.306-1.431a15.413 15.413 0 0 0-1.579 3.808l1.933.511a13.412 13.412 0 0 1 1.374-3.314L2.594 8.216zm.05 3.314l-.833-.734-1.323 1.5.832.734 1.323-1.5zm.587 11.346a14.403 14.403 0 0 1-1.123-2.709l-1.916.574a16.403 16.403 0 0 0 1.279 3.085l1.76-.95zm-1.42-1.672l.832-.733-1.323-1.5-.832.733 1.323 1.5zm-.796-1.228c.358 1.351.893 2.63 1.579 3.808l1.728-1.005a13.411 13.411 0 0 1-1.374-3.314l-1.933.511zm2.38 2.308l-1.107.069.125 1.996 1.108-.07-.125-1.995z"
                    fill="currentColor"></path>
                <path clip-rule="evenodd" d="M16 21a5 5 0 1 0 0-10 5 5 0 0 0 0 10z" stroke="currentColor"
                      stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            <h4 class="text-blue-900 font-medium mb-3">Daily Client Reports</h4>
            <p class="text-lg leading-tight">At the end of each day, we send you a report for all the activities that most matter to you. Clients recorded, converted and more.</p>
        </div>
        <div class="w-full sm:w-1/2 lg:w-1/3 sm:px-6 sm:mb-12">
            <svg class="block h-8 mb-6 text-teal-500" viewBox="0 0 30 32" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" d="M15 1l14 8c0 10-4.667 18-14 22C5.667 27 1 19 1 9l14-8z"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            <h4 class="text-blue-900 font-medium mb-3">Approvals of important transactions</h4>
            <p class="text-lg leading-tight">For important transactions such as deals, and edit of critical client details, the admin approves them and necessary parties are notified</p>
        </div>
    </div>
</section>

<div class="container mx-auto px-4">
    <hr class="block border-b-2 border-gray-500 opacity-10">
</div>

<footer class="px-4 py-12 text-center text-gray-600 text-md">
    <div class="flex items-center justify-center mb-6">
        <a href="#" class="mx-5 text-gray-700 hover:bg-gray-500">Terms of Use</a>
        <span class="text-gray-400 align-bottom">.</span>
        <a href="#" class="mx-5 text-gray-700 hover:bg-gray-500">Privacy Policy</a>
        <span class="text-gray-400 align-bottom">.</span>
        <a href="#" class="mx-5 text-gray-700 hover:bg-gray-500">All rights Reserved</a>
    </div>
    Copyright © {!! now()->year !!} {!! config('company.name') !!}.
</footer>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
