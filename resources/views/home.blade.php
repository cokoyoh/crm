@extends('layouts.app')

@section('content')
    <div class="-mx-3 bg-gray-200 overflow-auto">
        <div class="mx-auto px-24 pt-1 pb-6 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b pb-6">
                <div class="flex items-center">
                <span>
                    <img class="h-12 w-12 rounded-full border-2 border-gray-200"
                         src="/images/default.png" alt="Your image here">
                </span>
                    <div class="ml-4 block leading-relaxed -mt-1">
                        <h3 class="text-md font-medium text-gray-900">{!! $greeting !!}, {!! auth()->user()->name !!}</h3>
                        <div class="flex items-start justify-between text-gray-600 text-xs">
                        <span class="flex items-center">
                            <svg
                                class="h-3 h-3 fill-current"
                                viewBox="0 0 20 20">
                                <path d="M9 12H1v6a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-6h-8v2H9v-2zm0-1H0V5c0-1.1.9-2 2-2h4V2a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v1h4a2 2 0 0 1 2 2v6h-9V9H9v2zm3-8V2H8v1h4z"/>
                            </svg>
                            <span class="ml-1">
                                {!! auth()->user()->company->name !!}
                            </span>
                        </span>
                            <span class="ml-5 flex items-center">
                            <span class="bg-teal-300 rounded-full p-1">
                                <svg
                                    class="h-2 h-2 fill-current text-teal-900"
                                    viewBox="0 0 20 20">
                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/>
                                </svg>
                            </span>
                            <span class="ml-1">Verified Account</span>
                        </span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <button class="focus:outline-none">
                        <svg class="h-5 w-5 fill-current text-gray-500 hover:text-teal-700">
                            <path d="M6 8v7h8V8a4 4 0 1 0-8 0zm2.03-5.67a2 2 0 1 1 3.95 0A6 6 0 0 1 16 8v6l3 2v1H1v-1l3-2V8a6 6 0 0 1 4.03-5.67zM12 18a2 2 0 1 1-4 0h4z"/>
                        </svg>
                    </button>

                    <form action="{!! route('logout') !!}" method="post">
                        @csrf
                        <button
                            class="ml-3 text-sm font-medium text-gray-700 bg-gray-200 px-2 py-1 rounded hover:bg-gray-100 focus:outline-none active:bg-gray-300 active:text-gray-900"
                            type="submit"
                        >Log out</button>
                    </form>
                </div>
            </div>

            <div class="mt-4 flex items-center justify-between">
                <div class="block">
                    <p class="text-gray-600 text-sm font-normal">Your Deals</p>
                    <h3 class="flex items-center">
                        <span class="text-gray-900 font-thin text-2xl">KES 2.320M</span>
                        <span class="ml-2 flex items-center text-gray-900 text-sm">
                            <span class="flex items-center mr-1">
                                <svg class="h-3 w-3 fill-current text-teal-600"
                                    viewBox="0 0 20 20">
                                    <path d="M9 3.828L2.929 9.899 1.515 8.485 10 0l.707.707 7.778 7.778-1.414 1.414L11 3.828V20H9V3.828z"/>
                                </svg>
                            </span>
                            12% <span class="ml-1 text-gray-600">since last month</span>
                        </span>
                    </h3>

                    <a href="#">
                        <button class="mt-1 flex items-center text-sm text-gray-700 bg-gray-200 hover:bg-gray-100 active:bg-gray-300 rounded px-2 py-1 focus:outline-none">
                           <span>
                                View Summary
                           </span>
                            <span>
                                <svg class="h-4 v-4 fill-current"
                                     viewBox="0 0 20 20">
                                <path
                                    d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/>
                            </svg>
                           </span>
                        </button>
                    </a>
                </div>

                <div class="block">
                    <a href="{!! route('leads.create') !!}">
                        <button class="focus:outline-none rounded-full bg-transparent border border-gray-400 ml-3 hover:bg-gray-100 active:bg-gray-200">
                            <svg class="h-8 w-8 fill-current text-gray-600"
                                viewBox="0 0 24 24">
                                <path class="heroicon-ui" d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"/>
                            </svg>
                        </button>
                    </a>

                    <h4 class="mt-2 text-gray-700 text-sm">Add Lead</h4>
                </div>
            </div>
        </div>

        <div class="h-screen mx-auto px-24 pt-5">
            @include('flash.message')
             <div class="flex items-center justify-between">
                 <h3 class="text-sm text-gray-900 font-medium">Overview</h3>
                 <button
                     class="mt-1 flex items-center text-xs text-gray-700 bg-gray-300 hover:bg-gray-200 active:bg-gray-400 rounded px-2 py-1 focus:outline-none">
                    <span>
                        Last 30 days
                    </span>
                     <span>
                        <svg class="h-4 v-4 fill-current"
                             viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>
                   </span>
                 </button>
             </div>

            @if(auth()->user()->isSuperAdmin())
                @include('.home.admin_overview')

                @include('.home.companies')

            @else
                @include('.home.users_overview')

                @include('.home.schedules')
            @endif
        </div>
    </div>
@endsection
