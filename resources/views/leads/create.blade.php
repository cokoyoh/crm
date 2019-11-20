@extends('layouts.app')

@section('content')
    <div class="-mx-3 bg-gray-200 overflow-auto">
        <div class="mx-auto px-24 pt-1 pb-6 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b pb-6">
                <div class="flex items-center">
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
                <p class="text-gray-900 text-lg font-medium">Add New Lead</p>

                <a href="{!! route('leads.index') !!}">
                    <button
                        class="ml-5 flex items-center pr-4 pl-2 py-2 text-sm font-medium text-white bg-gray-800 hover:bg-gray-700 rounded focus:outline-none">
                        <svg
                            class="fill-current h-4 w-4"
                            viewBox="0 0 20 20">
                            <path d="M3.828 9l6.071-6.071-1.414-1.414L0 10l.707.707 7.778 7.778 1.414-1.414L3.828 11H20V9H3.828z"/>
                        </svg>
                        <span class="ml-1">Back</span>
                    </button>
                </a>
            </div>
        </div>

        <div class="h-screen mx-auto px-24 pt-5">
            <lead-form
                company="{!! auth()->user()->company_id !!}"
                :genders={!! $genders !!}
            ></lead-form>
        </div>
    </div>
@endsection
