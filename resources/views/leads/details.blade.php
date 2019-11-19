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
                        <h3 class="text-md font-medium text-gray-900">{!! $lead->name !!}</h3>
                        <div class="flex items-start justify-between text-gray-600 text-xs">
                            <span class="flex items-center">
                                <svg
                                    class="h-3 h-3 fill-current"
                                    viewBox="0 0 20 20">
                                    <path d="M9 12H1v6a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-6h-8v2H9v-2zm0-1H0V5c0-1.1.9-2 2-2h4V2a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v1h4a2 2 0 0 1 2 2v6h-9V9H9v2zm3-8V2H8v1h4z"/>
                                </svg>
                                <span class="ml-1">
                                    {!! optional($lead->leadSource)->name !!}
                                </span>
                            </span>
                            @if($lead->status == 'Prospect')
                                <span class="ml-3 text-yellow-900 bg-yellow-300 rounded-full px-2 text-xs">Prospect</span>
                            @elseif($lead->status == 'Converted')
                                <span class="ml-3 text-teal-900 bg-teal-300 rounded-full px-2 text-xs">Converted</span>
                            @elseif($lead->status == 'Lost')
                                <span class="ml-3 text-red-900 bg-red-300 rounded-full px-2 text-xs">Lost</span>
                            @elseif($lead->status == 'New')
                                <span class="ml-3 text-green-900 bg-green-300 rounded-full px-2 text-xs">New</span>
                            @endif
                        </div>
                    </div>
                </div>

                @include('.home.partials.actions')

            </div>

            <div class="mt-4 flex items-center justify-between">
                <div class="block">
                    <p class="text-gray-600 text-sm font-normal">Related Deals</p>
                    <h3 class="flex items-center">
                        <span class="text-gray-900 font-thin text-2xl">KES 2.320M</span>
                        <span class="ml-2 flex items-center text-gray-900 text-sm">
                            <span class="ml-1 text-gray-600">since {!! $lead->created_at->toFormattedDateString() !!}</span>
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
                    <dropdown>
                        <template v-slot:trigger>
                            <button class="focus:outline-none rounded-full bg-transparent  ml-3 hover:bg-gray-100 active:bg-gray-200">
                                <svg class="h-8 w-8 fill-current text-gray-600"
                                     viewBox="0 0 24 24">
                                    <path d="M10 12a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0-6a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 12a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/>
                                </svg>
                            </button>
                        </template>

                        @can('manageLead', $lead)
                            <li class="dropdown-menu-item"><a href="#">Edit</a></li>
                        @endcan
                        @can('convertLead', $lead)
                            <li class="dropdown-menu-item"><a href="{!! route('leads.convert', $lead) !!}">Convert</a></li>
                        @endcan
                        @can('markAsLost', $lead)
                            <li class="dropdown-menu-item"><a href="{!! route('leads.lost', $lead) !!}">Lost</a></li>
                        @endcan
                        @can('reassign', $lead)
                            <li class="dropdown-menu-item">Reassign</li>
                        @endcan
                        @can('destroy', $lead)
                            <form action="{!! route('leads.destroy', $lead) !!}" method="post">
                                @csrf
                                @method('delete')
                                <li class="dropdown-menu-item">
                                    <button class="outline-none focus:outline-none" type="submit">Delete</button>
                                </li>
                            </form>
                        @endcan
                    </dropdown>
                </div>
            </div>
        </div>

        <div class="h-screen mx-auto px-24">
            <div class="mt-2">
                @include('flash.message')
            </div>
            <div class="mt-8 flex items-center justify-between">
                <h3 class="text-sm text-gray-900 font-medium">Recent Interactions</h3>
                    <div class="block">
                        <button
                            class="focus:outline-none rounded-full bg-transparent border border-gray-400 ml-8 hover:bg-gray-100 active:bg-gray-200"
                            @click="$modal.show('new-interaction-modal')"
                        >
                            <svg class="h-6 w-6 fill-current text-gray-600"
                                 viewBox="0 0 24 24">
                                <path class="heroicon-ui" d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"/>
                            </svg>
                        </button>

                        <h4 class="mt-1 text-gray-700 text-sm">Add Interaction</h4>
                    </div>
            </div>

            <interactions lead={!! $lead->id !!}></interactions>

            @include('leads.partials.notes')

            <new-interaction-modal
                :lead="{!! $lead->id !!}"
                :user="{!! auth()->id() !!}"
            ></new-interaction-modal>
        </div>
    </div>
@endsection
