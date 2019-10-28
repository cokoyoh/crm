@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        @include('.dashboards.superadmin.header')
        @include('.dashboards.admin.main')
    </div>
@endsection
