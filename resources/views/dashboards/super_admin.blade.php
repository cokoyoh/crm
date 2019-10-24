@extends('layouts.app')

@section('content')
{{--    <p>Some lubba dubba dub dub...</p>--}}

{{--   the header --}}



{{--    main section --}}

{{--    --}}{{--    left side --}}
{{--        - see a list of registered companies--}}
{{--        - display companies in a table--}}
{{--        - see total users--}}
{{--        ---}}


{{--    --}}{{--    right side --}}
{{--        - Today's schedules--}}
{{--        - Upcoming schedules--}}
{{--        - Recently added companies--}}
{{--        ---}}


{{--    end of main section--}}

    <div class="container mx-auto">
        @include('.dashboards.superadmin.header')
        @include('.dashboards.superadmin.main')
    </div>

@endsection
