@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        @include('.dashboards.user.header')

        <div id="user-main" class="flex border-t border-gray-300 -px-4">
            @include('.dashboards.user.user_details')

            <div class="w-3/4 px-5 py-5">
                <tabs>
                    <ul class="flex items-center justify-between w-3/4 mx-auto border rounded">
                        <li class="border-r bg-blue-600 px-8 py-2 font-medium text-sm text-white rounded">Schedules</li>
                        <li class="border-r px-8 py-2 font-medium text-sm text-gray-700">Clients</li>
                        <li class="border-r px-8 py-2 font-medium text-sm text-gray-700">Interactions</li>
                        <li class="border-r px-8 py-2 font-medium text-sm text-gray-700">Deals</li>
                        <li class="px-8 py-2 font-medium text-sm text-gray-700">Reports</li>
                    </ul>
                </tabs>
                @include('.dashboards.user.schedules')
            </div>
        </div>
    </div>
@endsection
