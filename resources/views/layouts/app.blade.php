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
<div class="flex w-full" id="app">
    @auth
        <div class="w-64 px-8 py-4 bg-gray-100 border-r overflow-auto">
            <a href="/">
                <img class="h-8 w-8" src="/images/logo.svg" alt="{!! config('app.name') !!} logo">
            </a>

            <nav class="mt-8">
                    @if(auth()->user()->isSuperAdmin())
                        <fieldset>
                            <a href="{!! route('home') !!}">
                                <h3 class="text-xs font-semibold text-gray-600 uppercase tracking-wide active:text-gray-700">Super Admin</h3>
                            </a>

                            <div class="mt-2 -mx-3">
                                <a href="#"
                                   class="flex align-center justify-between px-3 py-1 rounded-lg"
                                >
                                    <span class="text-sm font-medium text-gray-700">Roles</span>
                                    <span class="text-xs font-semibold text-gray-700"></span>
                                </a>
                                <a href="{!! route('companies.index') !!}"
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
                            <a href="{!! route('home') !!}">
                                <h3 class="text-xs font-semibold text-gray-600 active:text-gray-700 uppercase tracking-wide">Admin</h3>
                            </a>

                            <div class="mt-2 -mx-3">
                                <a href="#"
                                   class="flex align-center justify-between px-3 py-1 bg-gray-200 rounded-lg"
                                >
                                    <span class="text-sm font-medium text-gray-900">Approvals</span>
                                    <span class="text-xs font-semibold text-gray-700"></span>
                                </a>
                                <a href="{!! route('users.index') !!}"
                                   class="flex align-center justify-between px-3 py-1 rounded-lg"
                                >
                                    <span class="text-sm font-medium text-gray-700">Users</span>
                                    <span class="text-xs font-semibold text-gray-700"></span>
                                </a>
                                <a href="{!! route('lead-sources.index') !!}"
                                   class="flex align-center justify-between px-3 py-1 rounded-lg"
                                >
                                    <span class="text-sm font-medium text-gray-700">Sources</span>
                                    <span class="text-xs font-semibold text-gray-700"></span>
                                </a>
                                <a href="{!! route('products.index') !!}"
                                   class="flex align-center justify-between px-3 py-1 rounded-lg"
                                >
                                    <span class="text-sm font-medium text-gray-700">Products</span>
                                    <span class="text-xs font-semibold text-gray-700"></span>
                                </a>
                            </div>
                        </fieldset>
                    @endif

                    <fieldset class="mt-8">
                        <h3 class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Leads</h3>

                        <div class="mt-2 -mx-3">
                            @if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                                <a href="{!! route('leads.index') !!}"
                                   class="flex align-center justify-between px-3 py-1 bg-gray-200 rounded-lg"
                                >
                                    <span class="text-sm font-medium text-gray-900">All</span>
                                    <span class="text-xs font-semibold text-gray-700">{!! auth()->user()->leadsCount !!}</span>
                                </a>
                            @endif
                            <a href="{!! route('leads.assigned') !!}"
                               class="flex align-center justify-between px-3 py-1 rounded-lg"
                            >
                                <span class="text-sm font-medium text-gray-700">Assigned to me</span>
                                <span class="text-xs font-semibold text-gray-700">{!! auth()->user()->leads()->count() !!}</span>
                            </a>
                            <a href="{!! route('leads.converted') !!}"
                               class="flex align-center justify-between px-3 py-1 rounded-lg"
                            >
                                <span class="text-sm font-medium text-gray-700">Converted</span>
                                <span class="text-xs font-semibold text-gray-700">{!! auth()->user()->convertedLeads()->count() !!}</span>
                            </a>
                            <a href="{!! route('leads.lost') !!}"
                               class="flex align-center justify-between px-3 py-1 rounded-lg"
                            >
                                <span class="text-sm font-medium text-gray-700">Lost</span>
                                <span class="text-xs font-semibold text-gray-700">{!! auth()->user()->lostLeads()->count() !!}</span>
                            </a>
                        </div>
                    </fieldset>

                    <fieldset class="mt-8">
                        <h3 class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Deals</h3>

                        <div class="mt-2 -mx-3">
                            <a href="{!! route('deals.index') !!}"
                               class="flex align-center justify-between px-3 py-1 rounded-lg"
                            >
                                <span class="text-sm font-medium text-gray-700">All</span>
                                <span class="text-xs font-semibold text-gray-700"></span>
                            </a>
                            <a href="{!! route('deals.pending') !!}"
                               class="flex align-center justify-between px-3 py-1 rounded-lg"
                            >
                                <span class="text-sm font-medium text-gray-700">Pending</span>
                                <span class="text-xs font-semibold text-gray-700"></span>
                            </a>
                            <a href="{!! route('deals.won') !!}"
                               class="flex align-center justify-between px-3 py-1 rounded-lg"
                            >
                                <span class="text-sm font-medium text-gray-700">Won</span>
                                <span class="text-xs font-semibold text-gray-700"></span>
                            </a>
                            <a href="{!! route('deals.verified') !!}"
                               class="flex align-center justify-between px-3 py-1 rounded-lg"
                            >
                                <span class="text-sm font-medium text-gray-700">Verified</span>
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
    @endauth

    <div class="flex-1 min-w-0 flex flex-col bg-white">
        @yield('header')
        <div class="flex-1 overflow-auto">
            <main class="p-3">
                @yield('content')
            </main>

            <flash-message></flash-message>
            <error-message></error-message>

        </div>
    </div>
</div>

<script src="{{ mix('js/app.js') }}"></script>

</body>
</html>
