@extends('layouts.app')

@section('content')
    <div class="-mx-3 bg-gray-200 overflow-auto">
        <div class="mx-auto px-24 pt-1 pb-6 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b pb-6">
                <div class="flex items-center">
                    <span>
                        <img class="h-12 w-12 rounded-full border-2 border-gray-200"
                             src="/images/default-company.png" alt="Your image here">
                    </span>

                    <div class="ml-4 block leading-relaxed -mt-1">
                        <h3 class="text-md font-medium text-gray-900">{!! $dealArray['name'] !!}</h3>
                        <div class="flex items-start justify-between text-gray-600 text-xs">
                            <span class="flex items-center">
                                <svg
                                    class="h-3 h-3 fill-current"
                                    viewBox="0 0 20 20">
                                    <path d="M9 12H1v6a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-6h-8v2H9v-2zm0-1H0V5c0-1.1.9-2 2-2h4V2a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v1h4a2 2 0 0 1 2 2v6h-9V9H9v2zm3-8V2H8v1h4z"/>
                                </svg>
                                <span class="ml-1">
                                    {!! $dealArray['product'] !!}
                                </span>
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center ml-4">
                        @if($dealArray['stage'] == 'pending')
                            <span class="ml-3 text-yellow-900 bg-yellow-300 rounded-full px-2 text-xs">Pending Deal</span>
                        @elseif($dealArray['stage'] == 'won-and-verified')
                            <span class="ml-3 text-teal-900 bg-teal-300 rounded-full px-2 text-xs">Won & Verified Deal</span>
                        @elseif($dealArray['stage'] == 'lost')
                            <span class="ml-3 text-white bg-red-600 rounded-full px-2 text-xs">Lost Deal</span>
                        @elseif($dealArray['stage'] == 'won')
                            <span class="ml-3 text-green-900 bg-green-300 rounded-full px-2 text-xs">Won Deal</span>
                        @endif
                    </div>

                </div>

                @include('.home.partials.actions')

            </div>

            <div class="mt-4 flex items-center justify-between">
                <div class="block">
                    <p class="text-gray-600 text-sm font-normal">Deal Amount</p>
                    <h3 class="flex items-center">
                        <span class="text-gray-900 font-thin text-2xl">{!! $dealArray['amount'] !!}</span>
                        <span class="ml-2 flex items-center text-gray-900 text-sm">
                            <span class="ml-1 text-gray-600">with {!! $dealArray['client'] !!}</span>
                        </span>
                    </h3>

                    <a href="{!! route('deals.index') !!}">
                        <button class="mt-1 flex items-center text-sm text-gray-700 bg-gray-200 hover:bg-gray-100 active:bg-gray-300 rounded px-2 py-1 focus:outline-none">
                           <span>
                                View all deals
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
                    <dropdown>
                        <template v-slot:trigger>
                            <button class="focus:outline-none rounded-full bg-transparent  ml-3 hover:bg-gray-100 active:bg-gray-200">
                                <svg class="h-8 w-8 fill-current text-gray-600"
                                     viewBox="0 0 24 24">
                                    <path d="M10 12a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0-6a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 12a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/>
                                </svg>
                            </button>
                        </template>

                        @can('markAsWon', $deal)
                            <li class="dropdown-menu-item"><a href="{!! route('deals.mark-as-won', $deal) !!}">Won</a></li>
                        @endcan
                        @can('markAsLost', $deal)
                            <li class="dropdown-menu-item"><a href="{!! route('deals.mark-as-lost', $deal) !!}">Lost</a></li>
                        @endif
                    </dropdown>
                </div>
            </div>
        </div>

        <div class="h-screen mx-auto px-24">
            <div class="mt-2">
                @include('flash.message')
            </div>

            @include('deals.partials.notes')
        </div>
    </div>
@endsection
