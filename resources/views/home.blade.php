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
<body class="h-screen flex">

    <div class="w-64 px-8 py-4 bg-gray-100 border-r">
        <img class="h-8 w-8" src="/images/logo.svg" alt="{!! config('app.name') !!} logo">

        <nav class="mt-8">
            @if(auth()->user()->isSuperAdmin())
                <fieldset>
                    <h3 class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Super Admin</h3>

                    <div class="mt-2 -mx-3">
                        <a href="#"
                           class="flex align-center justify-between px-3 py-1 rounded-lg"
                        >
                            <span class="text-sm font-medium text-gray-700">Roles</span>
                            <span class="text-xs font-semibold text-gray-700"></span>
                        </a>
                        <a href="#"
                           class="flex align-center justify-between px-3 py-1 rounded-lg"
                        >
                            <span class="text-sm font-medium text-gray-700">Companies</span>
                            <span class="text-xs font-semibold text-gray-700"></span>
                        </a>
                    </div>
                </fieldset>
            @endif

            @if(auth()->user()->isAdmin())
                <fieldset class="mt-8">
                    <h3 class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Admin</h3>

                    <div class="mt-2 -mx-3">
                        <a href="#"
                           class="flex align-center justify-between px-3 py-1 bg-gray-200 rounded-lg"
                        >
                            <span class="text-sm font-medium text-gray-900">Approvals</span>
                            <span class="text-xs font-semibold text-gray-700"></span>
                        </a>
                        <a href="#"
                           class="flex align-center justify-between px-3 py-1 rounded-lg"
                        >
                            <span class="text-sm font-medium text-gray-700">Users</span>
                            <span class="text-xs font-semibold text-gray-700"></span>
                        </a>
                        <a href="#"
                           class="flex align-center justify-between px-3 py-1 rounded-lg"
                        >
                            <span class="text-sm font-medium text-gray-700">Sources</span>
                            <span class="text-xs font-semibold text-gray-700"></span>
                        </a>
                    </div>
                </fieldset>
            @endif

            <fieldset class="mt-8">
                <h3 class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Leads</h3>

                <div class="mt-2 -mx-3">
                    <a href="#"
                       class="flex align-center justify-between px-3 py-1 bg-gray-200 rounded-lg"
                    >
                        <span class="text-sm font-medium text-gray-900">All</span>
                        <span class="text-xs font-semibold text-gray-700">36</span>
                    </a>
                    <a href="#"
                       class="flex align-center justify-between px-3 py-1 rounded-lg"
                    >
                        <span class="text-sm font-medium text-gray-700">Assigned to me</span>
                        <span class="text-xs font-semibold text-gray-700">3</span>
                    </a>
                    <a href="#"
                       class="flex align-center justify-between px-3 py-1 rounded-lg"
                    >
                        <span class="text-sm font-medium text-gray-700">Converted</span>
                        <span class="text-xs font-semibold text-gray-700">1</span>
                    </a>
                    <a href="#"
                       class="flex align-center justify-between px-3 py-1 rounded-lg"
                    >
                        <span class="text-sm font-medium text-gray-700">Lost</span>
                        <span class="text-xs font-semibold text-gray-700"></span>
                    </a>
                </div>
            </fieldset>

            <fieldset class="mt-8">
                <h3 class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Deals</h3>

                <div class="mt-2 -mx-3">
                    <a href="#"
                       class="flex align-center justify-between px-3 py-1 rounded-lg"
                    >
                        <span class="text-sm font-medium text-gray-700">All</span>
                        <span class="text-xs font-semibold text-gray-700"></span>
                    </a>
                    <a href="#"
                       class="flex align-center justify-between px-3 py-1 rounded-lg"
                    >
                        <span class="text-sm font-medium text-gray-700">Closed</span>
                        <span class="text-xs font-semibold text-gray-700"></span>
                    </a>
                    <a href="#"
                       class="flex align-center justify-between px-3 py-1 rounded-lg"
                    >
                        <span class="text-sm font-medium text-gray-700">Verified</span>
                        <span class="text-xs font-semibold text-gray-700"></span>
                    </a>
                    <a href="#"
                       class="flex align-center justify-between px-3 py-1 rounded-lg"
                    >
                        <span class="text-sm font-medium text-gray-700">Pending</span>
                        <span class="text-xs font-semibold text-gray-700"></span>
                    </a>
                </div>
            </fieldset>

{{--            <fieldset class="mt-8">--}}
{{--                <h3 class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Reports</h3>--}}

{{--                <div class="mt-2 -mx-3">--}}
{{--                    <a href="#"--}}
{{--                       class="flex align-center justify-between px-3 py-1 rounded-lg"--}}
{{--                    >--}}
{{--                        <span class="text-sm font-medium text-gray-700">Deals</span>--}}
{{--                        <span class="text-xs font-semibold text-gray-700"></span>--}}
{{--                    </a>--}}
{{--                    <a href="#"--}}
{{--                       class="flex align-center justify-between px-3 py-1 rounded-lg"--}}
{{--                    >--}}
{{--                        <span class="text-sm font-medium text-gray-700">Leads</span>--}}
{{--                        <span class="text-xs font-semibold text-gray-700"></span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </fieldset>--}}
        </nav>
    </div>

    <div class="flex-1 min-w-0 bg-white">
        <div class="border-b-2 border-gray-300">
            <header class="px-6">
                <div class="flex justify-between items-center border-b border-gray-200 py-3">
                    <div class="flex-1">
                        <div class="relative w-64">
                           <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-6 w-6 fill-current text-gray-600"
                                     viewBox="0 0 20 20">
                                <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/>
                            </svg>
                           </span>
                            <input
                                class="block w-full placeholder-gray-600 text-gray-900 rounded border border-gray-400 pr-4 pl-10 py-2 text-sm"
                                type="text"
                                placeholder="Search"
                            >
                        </div>
                    </div>
                    <div class="flex items-center">
                        <button>
                            <svg class="h-6 w-6 fill-current text-gray-500">
                                <path d="M6 8v7h8V8a4 4 0 1 0-8 0zm2.03-5.67a2 2 0 1 1 3.95 0A6 6 0 0 1 16 8v6l3 2v1H1v-1l3-2V8a6 6 0 0 1 4.03-5.67zM12 18a2 2 0 1 1-4 0h4z"/>
                            </svg>
                        </button>
                        <button class="ml-6">
                            <img class="h-8 w-8 rounded-full object-cover border-2" src="/images/default.png" alt="Your image">
                        </button>
                    </div>
                </div>
                <div></div>
            </header>
        </div>
        <div></div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
