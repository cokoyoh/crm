@extends('layouts.app')

@section('header')
    <div class="flex items-center justify-between py-2">
        <div class="flex items-center">
            <h2 class="text-2xl font-semibold text-gray-900 leading-tight">Dashboard</h2>

            <div class="ml-6 flex items-center">
               <span class="rounded-full border-2 border-white">
                    <img class="h-6 w-6 rounded-full object-cover border-2" src="/images/default.png" alt="Your image">
               </span>

                <span class="-ml-2 rounded-full border-2 border-white">
                    <img class="h-6 w-6 rounded-full object-cover border-2" src="/images/default.png" alt="Your image">
               </span>

                <span class="-ml-2 rounded-full border-2 border-white">
                    <img class="h-6 w-6 rounded-full object-cover border-2" src="/images/default.png" alt="Your image">
               </span>

                <span class="-ml-2 rounded-full border-2 border-white">
                    <img class="h-6 w-6 rounded-full object-cover border-2" src="/images/default.png" alt="Your image">
               </span>
            </div>
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
                class="ml-5 flex items-center pr-4 pl-2 py-2 text-sm font-medium text-white bg-gray-800 hover:bg-gray-700 rounded focus:outline-none">
                <svg
                    class="fill-current h-4 w-4"
                    viewBox="0 0 20 20">
                    <path
                        d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"/>
                </svg>
                <span class="ml-1">New Lead</span>
            </button>
        </div>
    </div>
@endsection

@section('content')
@endsection
