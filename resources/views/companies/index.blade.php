@extends('layouts.app')

@section('content')
    <div class="flex-shrink-0">
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

                @include('.home.partials.actions')
            </div>

            <div class="flex items-center justify-between py-2">
                <div class="flex items-center">
                    <h2 class="text-xl font-semibold text-gray-800 leading-tight">Companies</h2>
                </div>

                <div class="flex items-center">
            <span class="inline-flex p-1 border bg-gray-200 rounded">
                <button class="px-2 py-1 rounded">
                    <svg class="h-6 w-6 text-gray-600 fill-current" viewBox="0 0 20 20">
                        <path d="M0 3h20v2H0V3zm0 4h20v2H0V7zm0 4h20v2H0v-2zm0 4h20v2H0v-2z"/>
                    </svg>
                </button>
                <button class="px-2 py-1 bg-white rounded shadow">
                    <svg class="h-6 w-6 text-gray-600 fill-current" viewBox="0 0 20 20">
                        <path d="M12 4H8v12h4V4zm2 0v12h4V4h-4zM6 4H2v12h4V4zM0 2h20v16H0V2z"/>
                    </svg>
                </button>
            </span>

                    <button
                        @click="$modal.show('new-lead-source-modal')"
                        class="ml-5 flex items-center pr-4 pl-2 py-2 text-sm font-medium text-white bg-gray-800 hover:bg-gray-700 rounded focus:outline-none active:bg-gray-700">
                        <svg
                            class="fill-current h-4 w-4"
                            viewBox="0 0 20 20">
                            <path
                                d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"/>
                        </svg>
                        <span class="ml-1">Company</span>
                    </button>
                </div>
            </div>
        </header>
    </div>

    <div class="h-screen my-auto bg-gray-200 -mx-3 px-24 overflow-auto">
        <div class="mt-2 rounded">
            <companies></companies>
        </div>
    </div>
@endsection
