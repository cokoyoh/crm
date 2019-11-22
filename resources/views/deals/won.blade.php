@extends('layouts.partials.tables')

@section('title')
    Won Deals
@endsection

@section('header-button')
    <a href="{!! route('deals.index') !!}">
        <button
            class="ml-5 flex items-center pr-4 pl-2 py-2 text-sm font-medium text-white bg-gray-800 hover:bg-gray-700 rounded focus:outline-none active:bg-gray-700">
            <svg
                class="fill-current h-4 w-4"
                viewBox="0 0 20 20">
                <polygon points="3.828 9 9.899 2.929 8.485 1.515 0 10 .707 10.707 8.485 18.485 9.899 17.071 3.828 11 20 11 20 9 3.828 9"/>
            </svg>
            <span class="ml-1">Back</span>
        </button>
    </a>
@endsection

@section('table')
    <deals api="/apis/deals/won"></deals>
@endsection
