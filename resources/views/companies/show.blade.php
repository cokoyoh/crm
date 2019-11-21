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
                        <h3 class="text-md font-medium text-gray-900">{!! $company->name !!}</h3>
                        <div class="flex items-start justify-between text-gray-600 text-xs">
                            <span class="flex items-center">
                                <svg
                                    class="h-3 h-3 fill-current"
                                    viewBox="0 0 20 20">
                                    <path d="M18 2a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h16zm-4.37 9.1L20 16v-2l-5.12-3.9L20 6V4l-10 8L0 4v2l5.12 4.1L0 14v2l6.37-4.9L10 14l3.63-2.9z"/>
                                </svg>
                                <span class="ml-1">
                                    {!! $company->email !!}
                                </span>
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center ml-4">
                        @if($company->status == 'Unverified')
                            <span class="ml-3 text-indigo-900 bg-indigo-300 rounded-full px-2 text-xs">Unverified</span>
                        @elseif($company->status == 'Active')
                            <span class="ml-3 text-teal-900 bg-teal-300 rounded-full px-2 text-xs">Active</span>
                        @elseif($company->status == 'Inactive')
                            <span class="ml-3 text-white bg-red-600 rounded-full px-2 text-xs">Inactive</span>
                        @endif
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
                            <span class="ml-1 text-gray-600">since {!! $company->created_at->toFormattedDateString() !!}</span>
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

                        @can('manageCompany', $company)
                            <li class="dropdown-menu-item"><a href="#">Edit</a></li>
                        @endcan
                    </dropdown>
                </div>
            </div>
        </div>

        <div class="h-screen mx-auto px-24">
            <div class="mt-2">
                @include('flash.message')
            </div>
        </div>
    </div>
@endsection
