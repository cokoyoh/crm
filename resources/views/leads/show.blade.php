@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        @include('leads.header')

        <div id="user-main" class="flex border-t border-gray-300 -px-4">
            @include('leads.lead_details')

            <div class="w-3/4 px-5 py-5">
                @include('flash.message')
                @include('leads.lead_main')
            </div>
        </div>
    </div>
@endsection
