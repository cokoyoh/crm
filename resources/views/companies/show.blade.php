@extends('layouts.app')

@section('content')
    <header class="flex items-center py-4 mb-4">
        <div class="flex justify-between items-end w-full">
            <p class="flex-1 text-gray-700 text-md font-normal no-underline">
                <a href="{!! route('companies.index') !!}" class="text-gray-700 text-md font-normal no-underline">
                    Companies</a>/ {!! $company->name !!}
            </p>

            <div class="flex items-center">
                <a href="{!! $company->path() .'/edit' !!}" class="btn btn-blue ml-4">Edit Company</a>
            </div>
        </div>
    </header>


    <main>
        <div class="flex justify-between">
            <div class="w-3/4">
                <h3 class="text-lg text-gray-700 font-normal mt-5 mb-8">Company Details</h3>

                @include('companies.partials.details')

                @include('companies.partials.users')

            </div>

            <div class="w-1/4">
                <p>The right side</p>
            </div>

        </div>

    </main>

@endsection
