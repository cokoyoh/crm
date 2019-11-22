@extends('layouts.partials.tables')

@section('title')
    Leads
@endsection

@section('header-button')
    <a href="{!! route('leads.create') !!}">
        <button
            class="ml-5 flex items-center pr-4 pl-2 py-2 text-sm font-medium text-white bg-gray-800 hover:bg-gray-700 rounded focus:outline-none active:bg-gray-700">
            <svg
                class="fill-current h-4 w-4"
                viewBox="0 0 20 20">
                <path
                    d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"/>
            </svg>
            <span class="ml-1">Lead</span>
        </button>
    </a>
@endsection

@section('table')
    <leads></leads>
@endsection
