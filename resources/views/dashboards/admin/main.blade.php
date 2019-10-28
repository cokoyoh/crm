<div class="flex mt-5">

    <div class="w-3/4">
        @include('dashboards.admin.snap_details')

        @include('dashboards.admin.users_table')
    </div>


    <div class="w-1/4 ml-8">
        @include('dashboards.schedules.today')
        @include('dashboards.schedules.upcoming')
        @include('dashboards.admin.recent_activities')
    </div>
</div>
