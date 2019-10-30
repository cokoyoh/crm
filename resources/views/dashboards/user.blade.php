@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        @include('.dashboards.user.header')

        <div id="user-main" class="flex border-t border-gray-300 -px-4">
            @include('.dashboards.user.user_details')

            <div class="w-3/4 px-5 py-5">

                <tabs>
                    <tab title="Schedules" active>
                        @include('.dashboards.user.schedules')
                    </tab>

                    <tab title="Leads">
                        <p>Leads here</p>
                    </tab>

                    <tab title="Clients">
                        <p>Clients here</p>
                    </tab>

                    <tab title="Interactions">
                        <p>Interactions here</p>
                    </tab>

                    <tab title="Deals" active>
                        <p>Deals here</p>
                    </tab>

                    <tab title="Reports">
                        <p>Reports</p>
                    </tab>
                </tabs>

            </div>
        </div>
    </div>
@endsection
